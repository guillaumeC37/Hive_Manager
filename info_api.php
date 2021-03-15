<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	info_api.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Affiche les infos de l'apiculteur								 *
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
/* Pour debug
echo "<pre>Session :";
print_r($_SESSION);
echo "</pre>";
echo "<pre>POST :";
print_r($_POST);
echo "</pre>";
*/
	if (isset($_SESSION['ID_API']))
	{
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$ID_Api=$_SESSION['ID_API'];
		$SQLS="SELECT Login,Code_APE,Code_API,SIRET,NUMAGRI,Nom_Api,Prenom_Api, Ad_Mail, Ville, Num_Rue,Nom_Rue,Code_Postal,Nom_Type FROM vue_apiculteur WHERE ID_Apiculteur=$ID_Api";
		foreach($DBConn->query($SQLS) as $row)
		{
			$Login=$row['Login'];
			$Code_APE=$row['Code_APE'];
			$Code_API=$row['Code_API'];
			$SIRET=$row['SIRET'];
			$NUMAGRI=$row['NUMAGRI'];
			$Nom_Api=$row['Nom_Api'];
			$Prenom_Api=$row['Prenom_Api'];
			$Ad_Mail=$row['Ad_Mail'];
			$Ville=$row['Ville'];
			$Num_Rue=$row['Num_Rue'];
			$Nom_Rue=$row['Nom_Rue'];
			$Code_Postal=$row['Code_Postal'];
			$Nom_Type=$row['Nom_Type'];					
		}
		$template->assign('nom',$Nom_Api);
		$template->assign('prenom',$Prenom_Api);
		$template->assign('login',$Login);
		$template->assign('numero',$Num_Rue);
		$template->assign('typerue',$Nom_Type);
		$template->assign('nomrue',$Nom_Rue);
		$template->assign('cp',$Code_Postal);
		$template->assign('nomville',$Ville);
		$template->assign('adressemail',$Ad_Mail);
		$template->assign('numagri',$NUMAGRI);
		$template->assign('napi',$Code_API);
		$template->assign('siret',$SIRET);
		$template->assign('ape',$Code_APE);
		$Page=$CheminTpl.'info_api.tpl';
	}
	else
	{
		//No man's land
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