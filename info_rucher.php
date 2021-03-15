<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	info_rucher.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Affiche les infos du rucher										 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  $template=new Smarty(); 
  $CheminTpl='../templates/';
//On verifie si on est dans la session
  if (isset($_SESSION['InSession'])&&isset($_SESSION['ID_Rucher']))
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
	  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	  $Id_Rucher=$_SESSION['ID_Rucher'];
	  $SQLS="SELECT Nom_Rucher, Localisation,Num_Rucher,IsActif, Coordonnees_GPS,Observations, Nom_Api,Prenom_Api FROM Vue_Rucher_Api WHERE Id_Rucher=$Id_Rucher";
	  foreach($DBConn->query($SQLS) as $row)
	  {
		$NomRucher=$row['Nom_Rucher'];
		$NumRucher=$row['Num_Rucher'];
		$Actif=$row['isActif'];
		$Loc=$row['Localisation'];
		$Coord=$row['Coordonnees_GPS'];
		$Obs=$row['Observations'];
		$Identite=$row['Prenom_Api']." ".$row['Nom_Api'];		
	  }
	  //Gestion actif
	  if($Actif==1)// Rucher actif
		{
		   $ImageRucher="check";
		}
		else  //Rucher inactif
		{
			$ImageRucher="mort";
		}
	  //On parse la page
	  $template->assign('Nom_prenom',$Identite);
	  $template->assign('NomRucher',$NomRucher);
	  $template->assign('NumRucher',$NumRucher);
	  $template->assign('Actif',$ImageRucher);
	  $template->assign('Loc',$Loc); 
	  $template->assign('GPS',$Coord);
	  $template->assign('Observations',$Obs);
	  $Page=$CheminTpl.'info_rucher.tpl';
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