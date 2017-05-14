<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	supp_essaim.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Ajoute une ruche au rucher										 *
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
echo "<pre> Session :";
print_r ($_SESSION);
echo "<p>Post</p>";
print_r ($_POST);
echo "</pre>";  
*/	
	$TemplateUser=$_SESSION['Template_User'];
	$template->assign('TemplateUser',$TemplateUser);
	$Erreur=0;
	if (isset($_SESSION['ID_Ruche']))
	{
		$ID_Ruche=$_SESSION['ID_Ruche'];
	}
	else
		$Erreur=1;
	if (isset($_SESSION['ID_API']))
	{
		$ID_Api=$_SESSION['ID_API'];
	}
	else
		$Erreur=1;
	if (isset($_SESSION['ID_Essaim']))
	{
		$ID_Essaim=$_SESSION['ID_Essaim'];
	}
	else
		$Erreur=1;
	
	if ($Erreur==0)
	{
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		//selection du nom de la ruche en cours
		$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$ID_Ruche";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomRucheAff=$row['Nom_Ruche'];
		}
		$template->assign('Nom_RucheSel',$NomRucheAff);
		//
		//On affiche les essaims affectés et on parse (cf ajout essaim)
		//On selectionne les infos Ruches-Essaim appartenant à l'apiculteur
		$SQLS="SELECT ID_ESSAIM,NOM_ESSAIM, Nom_Ruche FROM vue_essaim_nomruche WHERE Id_Apiculteur=$ID_Api and ID_ESSAIM<>$ID_Essaim";
		$i=0;
		$MaTable=array();
		foreach($DBConn->query($SQLS) as $row)
		{
			$MaTable[$i]['ID_E']=$row['ID_ESSAIM'];
			$MaTable[$i]['NomE']=$row['NOM_ESSAIM'];
			$MaTable[$i]['NomR']=$row['Nom_Ruche'];
			$i++;
		}
		$template->assign('liste_essaims',$MaTable);
		//On affecte le nom de l'essaim actuel
		$SQLS="SELECT NOM_ESSAIM FROM essaim WHERE ID_ESSAIM=$ID_Essaim";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomEssaim=$row['NOM_ESSAIM'];
		}
		$template->assign('NomEssaim',$NomEssaim);
		$Page=$CheminTpl.'supp_aff_essaim.tpl';
		//On parse la page
		$template->display($Page);
	} //Fin OK valeurs session
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