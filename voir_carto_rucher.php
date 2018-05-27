<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	carto_rucher.php								 *
 * Date création :	26/05/2018										 *
 * Date Modification :	26/05/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Affichage des ruches sur le rucher								 *
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
		if ($Id_Rucher>0)
		{
			//On se connecte à la base de données
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			//Récupération des infos nécessaires du rucher
			$SQLS="SELECT Nom_Rucher, Num_Rucher, Path_Image FROM Rucher WHERE ID_Rucher=".$Id_Rucher;
			foreach($DBConn->query($SQLS) as $row)
			{
				$NomRucher=$row['Nom_Rucher'];
				$NumRucher=$row['Num_Rucher'];
				$Image_Rucher=$row['Path_Image'];
			}
			$template->assign('NomRucher',$NomRucher);
			$template->assign('NumRucher',$NumRucher);
			//Si l'image du rucher est vide :
			if($Image_Rucher=='')
			{
			
				//Page vide
				$Page=$CheminTpl.'carto_vierge.tpl'; //A changer
				
			}
			else
			{
				//On charge le canvas rucher.
		
				$Page=$CheminTpl.'carto_rucher.tpl'; //a changer
			}
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