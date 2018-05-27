<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	carto_ruche.php									 *
 * Date création :	27/05/2018										 *
 * Date Modification :	27/05/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Positionne la ruche sur la carte du rucher						 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
	session_start();
	require("include/smarty.class.php");
	include "include/config.inc.php";
	include "include/function.inc.php";
	$template=new Smarty(); 
	$CheminTpl='../templates/';
	//On verifie si on est dans la session
	if (isset($_SESSION['InSession']))
	{
		$InSession=$_SESSION['InSession'];
	}
	else
		$InSession=false;	
	if ($InSession) //On est dans la session
	{
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$Id_Rucher=$_SESSION['ID_Rucher'];
		$ID_Api=$_SESSION['ID_API'];
		$ID_Ruche=$_SESSION['ID_Ruche'];
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		if ($ID_Ruche>0)  //On a bien une ruche selectionnée
		{
			//On a poster des nouvelles valeurs
			if(isset($_POST['Id_Ruche']))
			{
				//On récupère les valeurs
				if(isset($_POST['X_Ruche']))
				{
					$Nvo_X=$_POST['X_Ruche'];
				}
				else
					$Nvo_X=0;
				if(isset($_POST['Y_Ruche']))
				{
					$Nvo_Y=$_POST['Y_Ruche'];
				}
				else
					$Nvo_Y=0;
				if(isset($_POST['Zoom_Ruche']))
				{
					$Nvo_Z=$_POST['Zoom_Ruche'];
				}
				else
					$Nvo_Z=0;
				//On enregistre dans la base de données les nouvelles infos
				$TableValeur=array(':Id_La_Ruche'=>$ID_Ruche,':X_La_Ruche'=>$Nvo_X,':Y_La_Ruche'=>$Nvo_Y,':Z_La_Ruche'=>$Nvo_Z);
				//On prépare la requete
				$SQLS="CALL P_Update_Coord_Ruche(:X_La_Ruche,:Y_La_Ruche,:Z_La_Ruche,:Id_La_Ruche)";
				$query=$DBConn->prepare($SQLS);
				//Execute la requete
				$query->execute($TableValeur); 
				$count=$query->rowCount();
				if($count==1)
				{
					 $template->assign('Resultat','Modification effectu&eacute;e');//OK
				}
				else
				{
					   $template->assign('Resultat','Erreur lors de la modification');//pas OK
				}
			}
			$template->assign('ID_RUCHE',$ID_Ruche);
			//Récupération de l'image du rucher
			$ImageRucher='';
			$SQLS="SELECT Nom_Rucher, Num_Rucher, Path_Image FROM Rucher WHERE ID_Rucher=".$Id_Rucher;
			foreach($DBConn->query($SQLS) as $row)
			{
				$NomRucher=$row['Nom_Rucher'];
				$NumRucher=$row['Num_Rucher'];
				$Image_Rucher=$row['Path_Image'];
			}
			$template->assign('NOMRUCHER',$NomRucher);
			$template->assign('NUMRUCHER',$NumRucher);
			$ImageRucher=$Image_Rucher;
			//Si image de rucher définie on continue
			if(isset($ImageRucher)&&($ImageRucher!=''))
			{
				$CheminPhotoRucher="images/carto/$ID_Api/".$Image_Rucher;
				$template->assign('CHEMIN_PHOTO',$CheminPhotoRucher); //remplacer par chemin de la photo du rucher
				//On récupère les coordonnées de la ruche dans la base
				$SQLS="SELECT * FROM vue_coord_ruches WHERE ID_Ruche=".$ID_Ruche;
				foreach($DBConn->query($SQLS) as $row)
				{
					$X_Ruche=$row['X_Ruche'];
					$Y_Ruche=$row['Y_Ruche'];
					$Z_Ruche=$row['Z_Ruche'];
					$Nom_Ruche=$row['Nom_Ruche'];
				}
				if($X_Ruche=='')
				{
					$X_Ruche=0;
				}
				if($Y_Ruche=='')
				{
					$Y_Ruche=0;
				}
				if($Z_Ruche=='')
				{
					$Z_Ruche=0;
				}
				$template->assign('NOMRUCHE',$Nom_Ruche);
				$template->assign('XRUCHE',$X_Ruche);	
				$template->assign('YRUCHE',$Y_Ruche); //remplacer par les coordonnnées de la ruche, facon(x,y,z);
				$template->assign('ZRUCHE',$Z_Ruche);
				//On dirige vers la page
				$Page=$CheminTpl.'carto_ruche.tpl';
			}
			else
			{
				//page d'erreur avec image rucher non définie
				$ErreurMsg="La cartographie du rucher n'a pas &eacute;t&eacute; d&eacute;finie";
				$template->assign('Erreur_Msg',$ErreurMsg);
				$Page=$CheminTpl.'erreur_carto.tpl';
			}
		}  //fin de if on est dans la ruche
		else
		{ //On est pas dans le rucher
			$Page=$CheminTpl.'erreur_rucher.tpl';
		}
		//On parse la page
		$template->display($Page);
	}//Fin de on est dans la session
	else
	{
	  //On est pas dans la session
	  //On parse la page
		$Page=$CheminTpl.'erreur.tpl';
		$template->display($Page);
	}
	//traitement quoi qu'il en soit
	$Pied=new Smarty(); 
	$DBConn2=connectbase($userdb,$passdb,$servdb,$nomdb);
	$SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Version'";
	foreach($DBConn2->query($SQLS) as $row)
	{
	$Version=$row['Value_Param'];  
	}
	$Pied->Assign('Version',$Version);
	$Pied->display($CheminTpl.'pied.tpl');
?>