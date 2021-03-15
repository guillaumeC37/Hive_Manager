<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	save_carto.php									 *
 * Date création :	26/05/2018										 *
 * Date Modification :	27/05/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Sauvegarde la carto au format PNG								 *
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
		$OK=true; // Pour création fichier
		if ($Id_Rucher>0)
		{
			$CheminImage="documents/$ID_Api/temp/carto/";
			$Suffixe='-'.date('Y-m-d');
			$Nom_Image=$Id_Rucher.$Suffixe.'.png';
			$NomFichier=$CheminImage.$Id_Rucher.$Suffixe.'.png';
			if (isset($_POST['Image_Ruche']))
			{
				$data=$_POST['Image_Ruche'];
				$image=explode('base64,',$data);
				$fic=fopen($NomFichier,'wb');
				$OK=fwrite($fic, base64_decode($image[1]));
				fclose($fic);
			}
			if($OK)
			{
				$template->assign('Nom_Fichier',$NomFichier);
				//On enregistre le chemin du fichier dans la base pour affichage ultérieur
				$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
				$TableValeur=array(':IDRUCHER'=>$Id_Rucher,':Nom_Image'=>$Nom_Image);
				//On prépare la requete
				$SQLS="CALL P_Update_LastImage_Rucher(:Nom_Image,:IDRUCHER)";
				$query=$DBConn->prepare($SQLS);
				//Execute la requete
				$query->execute($TableValeur); 
				$count=$query->rowCount();
				if($count==1)
				{
					 $template->assign('Resultat','Modification effectu&eacute;e');//OK //inutile
				}
				else
				{
					   $template->assign('Erreur','Erreur lors de la modification');//pas OK
				}
			}
			else
			{
				$template->assign('Erreur',"Le fichier n'a put &ecirc;tre cr&eacute;&eacute;");
			}
			$Page='save_carto.tpl';
		}  //fin de if on est dans le rucher
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
