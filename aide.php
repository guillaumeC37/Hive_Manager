<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	Aide.php										 *
 * Date création :	23/02/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version : 0.2A													 *
 * Objet et notes :		prend en charge la gestion de l'aide		 *
 *	du systeme.														 *
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
	if (isset($_GET["Id_Page"]))
	{
		//On est dans la demande d'une page d'aide spécifique

		$IdPage=(int)$_GET["Id_Page"];
		$Page='';
		switch($IdPage)
		{
			case 0 : $Page='index';
					break;
			case 1 : $Page='accueil';
					break;
			case 2 : $Page='rucher';
					break;
			case 3 : $Page='ruche';
					break;		
			default : $Page='';					
		}
		
	}
	else
		$Page='index';
	  //On parse la page
	$template->display('../aide/'.$Page.'.tpl');
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