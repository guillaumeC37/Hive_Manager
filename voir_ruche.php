<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_ruche.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Voir la liste des ruches du rucher								 *
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
		}
		else  //On a pas d'IDRuche, ni dans la session, ni dans le post
		{
			$ID_Ruche=0;
		}
	}//Fin de recherche de l'ID Ruche
	if ($ID_Ruche>0)  //On a bien un ID Ruche
	{
		//On affiche les informations sur la ruche
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$SQLS="SELECT NUM_RUCHE, Nom_Ruche, EPHOTO,TPHOTO, Nom_Rucher, NOM_TYPE_RUCHE FROM vue_ruche_complete_sans_api WHERE ID_Ruche=$ID_Ruche";
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		foreach($DBConn->query($SQLS) as $row)
	    {
			$NomRucher=$row['Nom_Rucher'];
			$NomRuche=$row['Nom_Ruche'];
			$NumRuche=$row['NUM_RUCHE'];
			$EPhoto=$row['EPHOTO'];
			$TypeRuche=$row['NOM_TYPE_RUCHE'];
			$TPHOTO=$row['TPHOTO'];
		}
		//On parse
		$Phtoto=$TPHOTO.$EPhoto; 
		$template->assign('TypeRuche',$TypeRuche);
		$template->assign('NomRuche',$NomRuche);
        $template->assign('NumRuche',$NumRuche);
        $template->assign('EtatRuche',$Phtoto);
		$template->assign('NomRucher',$NomRucher);
		//On récupère les infos de l'essaim
		$SQLS="SELECT ID_ESSAIM,NOM_ESSAIM FROM vue_essaim_nomruche WHERE ID_RUCHE=$ID_Ruche";
		foreach($DBConn->query($SQLS) as $row)
	    {			
			$ID_Essaim=$row['ID_ESSAIM'];
			$NomEssaim=$row['NOM_ESSAIM'];
		}
		//Si IdEssaim n'est pas créé, c'est qu'on a reçu aucun enregistrement.
		if (!(isset($ID_Essaim)))
		{
			$NomEssaim="Aucun essaim";
		    $template->assign('NomEssaim',$NomEssaim);
			$ID_Essaim=0;
			$template->assign('ImageEssaim','essaim_vide');
			$template->assign('IdEssaim',$ID_Essaim);
			//Utiliser la bonne image
		}
		else
		{			
		    $template->assign('NomEssaim',$NomEssaim);
			$template->assign('IdEssaim',$ID_Essaim);
			$template->assign('ImageEssaim','essaim');
			//Utiliser la bonne image
		}
		$Page=$CheminTpl.'voir_ruche.tpl';
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