<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_info_ruche.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Voir les informations de la ruche								 *
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
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";  
*/	  
    //ID Ruche dans post ?
	if (isset($_POST['id_ruche']))
	{
		$ID_Ruche=(int)$_POST['id_ruche'];  //On récupère ID Ruche
		//On stocke l'ID dans la session
		$_SESSION['ID_Ruche']=$ID_Ruche;
	}
	else  //On essai de voir si l'ID est dans la session
	{
		if(isset($_SESSION['ID_Ruche']))
		{
			$ID_Ruche=$_SESSION['ID_Ruche'];
			$TemplateUser=$_SESSION['Template_User'];
			$template->assign('TemplateUser',$TemplateUser);
		}
		else  //On a pas d'IDRuche, ni dans la session, ni dans le post
		{
			$ID_Ruche=0;
			$TemplateUser=$_SESSION['Template_User'];
			$template->assign('TemplateUser',$TemplateUser);
		}
	}//Fin de recherche de l'ID Ruche
	if ($ID_Ruche>0)  //On a bien un ID Ruche
	{
		//On affiche les informations sur la ruche
		$SQLS="SELECT Date_MES, NBRE_CADRE, NBRE_HAUSSE, NUM_RUCHE, Nom_Ruche, OBSERV, NOM_ETAT, Nom_Rucher, NOM_TYPE_RUCHE, type_cadre FROM vue_ruche_complete_sans_api WHERE ID_Ruche=$ID_Ruche";
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		foreach($DBConn->query($SQLS) as $row)
	    {
			$NomRucher=$row['Nom_Rucher'];
			$NomRuche=$row['Nom_Ruche'];
			$NumRuche=$row['NUM_RUCHE'];
			$DateRuche=$row['Date_MES'];
			$TypeRuche=$row['NOM_TYPE_RUCHE'];
			$NbeCadres=$row['NBRE_CADRE'];
			$Etat=$row['NOM_ETAT'];
			$TypeH=$row['type_cadre'];
			$NbreHausses=$row['NBRE_HAUSSE'];
			$Obs=$row['OBSERV'];
		}
		//On verifie si date et observations sont vides ou non
		if ($Obs=='')
		{
			$Obs="Aucune informations";
		}
		//Mise en forme de date
		if ($DateRuche=='0000-00-00')
		{
			$DateRuche="Non renseign&eacute;e";
		}
		else
		{
			$DateRuche=convertDate($DateRuche,1);
		}
		//On parse
		$template->assign('NomRucher',$NomRucher);
	    $template->assign('NomRuche',$NomRuche);
	    $template->assign('DateCreation',$DateRuche);
	    $template->assign('NumRuche',$NumRuche);
	    $template->assign('TypeRuche',$TypeRuche);
	    $template->assign('NbreCadre',$NbeCadres);
	    $template->assign('Etat',$Etat);
	    $template->assign('TypeHausses',$TypeH);
	    $template->assign('NbreHausses',$NbreHausses);
	    $template->assign('Observations',$Obs);
		//la page
		$Page=$CheminTpl.'voir_info_ruche.tpl';
	}//Fin de on a bien l'ID Ruche
	else
	{	
	//On affiche une page d'erreur car normalement, on a pas a arriver a cette situation
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