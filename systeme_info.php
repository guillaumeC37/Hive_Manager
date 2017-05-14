<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	systeme_info.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Affiche les informations version base et logiciel				 *
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
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
	if (isset($_SESSION['ID_API']))
	{
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Version'";
		foreach($DBConn->query($SQLS) as $row)
		{
			$VersionBase=$row['Value_Param'];  
		}
	  //On parse la page
		$template->assign('VersionBase',$VersionBase);
		$template->assign('VersionLog',$Version_Soft);
		$template->display($CheminTpl.'systeme_info.tpl');
	}
	else
	{
		//No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	}
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