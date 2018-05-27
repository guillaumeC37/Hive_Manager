<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_rucher.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Voir les informations du rucher									 *
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
		/**$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$_SESSION['ID_Rucher']=$Id_Rucher;*/

		$Page=$CheminTpl.'carto.tpl';
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