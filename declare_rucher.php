<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	declare_rucher.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère la page récupérant les données type pour la 				 *
 *	déclaration du rucher											 *
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
echo "<pre> Session :";
print_r ($_SESSION);
echo "</pre>";
*/
	$TemplateUser=$_SESSION['Template_User'];
	$template->assign('TemplateUser',$TemplateUser);
	$ID_Rucher=$_SESSION['ID_Rucher'];
	$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	$SQLS="SELECT Nom_Api,Prenom_Api,Ville,Num_Rue,nom_Rue,Code_Postal,SIRET,Code_API,Nom_Type,Nom_Rucher,Localisation,Num_Rucher FROM vue_rucher_declaration WHERE id_Rucher=$ID_Rucher";
	foreach($DBConn->query($SQLS) as $row)
	{
		$NomApi=$row['Nom_Api'];
		$PrenomApi=$row['Prenom_Api'];
		if (isset($row['SIRET']))
		{
			$SIRET=$row['SIRET'];
		}
		else
			$SIRET='';
		//Formatage de l'adresse
		$Adresse=$row['Num_Rue'].' '.$row['Nom_Type'].' '.$row['nom_Rue'];
		$Adresse2=$row['Code_Postal'].' '.$row['Ville'];	
		$NAPI=$row['Code_API'];
		$NomRucher=$row['Nom_Rucher'];
		$Localisation=$row['Localisation'];
		$NumRucher=$row['Num_Rucher'];
	}
	$template->assign('NomApi',$NomApi);
	$template->assign('PrenomApi',$PrenomApi);
	$template->assign('Adresse',$Adresse);
	$template->assign('Adresse2',$Adresse2);
	$template->assign('SIRET',$SIRET);
	$template->assign('NAPI',$NAPI);
	$template->assign('NomRucher',$NomRucher);
	$template->assign('Localisation',$Localisation);
	$template->assign('NumRucher',$NumRucher);
	$SQLS="SELECT count(*) AS Compte FROM ruche WHERE id_Rucher=$ID_Rucher";
	foreach($DBConn->query($SQLS) as $row)
	{
		$Compte=$row['Compte'];
	}
	//On parse la page
	$template->assign('Nbre_Ruche',$Compte);
	$Page=$CheminTpl.'declare_rucher.tpl';
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