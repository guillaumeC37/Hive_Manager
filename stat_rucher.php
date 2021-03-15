<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_rucher.php									 *
 * Date création :	25/02/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	0.2A												 *
 * Objet et notes :													 *
 *		Affiches les statistiques du rucher							 *
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
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
	  if (isset($_SESSION['ID_Rucher']))
	  {
		  $ID_Rucher=$_SESSION['ID_Rucher'];
		  //récupération du nom du rucher et affichage
		  $SQLS="SELECT Nom_Rucher FROM rucher WHERE id_Rucher=$ID_Rucher";
		  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $NomRucher=$row['Nom_Rucher'];
		  }
		  $template->assign('NomRucher',$NomRucher);
		  //Selectionne le nombre de ruche total dans le rucher
		  $SQLS="SELECT count(*) AS compte FROM ruche WHERE ID_Rucher=$ID_Rucher";
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $NbreRuche=$row['compte'];
		  }
		  $template->assign('NombreRuche',$NbreRuche);
		  //Récupère le nombre de ruche en fonction de leur état
		  $SQLS="SELECT count(R.ID_ETAT) as nombre,E.NOM_ETAT FROM etat_ruche E LEFT JOIN ruche R ON E.ID_ETAT=R.ID_ETAT WHERE ID_Rucher=$ID_Rucher GROUP BY E.ID_ETAT";
		  $i=0;
		  $TabEtat=array();
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $TabEtat[$i]['Nom']=$row['NOM_ETAT'];
			  $TabEtat[$i]['Nombre']=$row['nombre'];
			  $i++;
		  }
		  $template->assign('ListeEtat',$TabEtat);
		  //Récupère la quantité de récolte totale pour le rucher
		  $SQLS="SELECT SUM(Re.Poids) as Poids FROM recolte Re INNER JOIN ruche ON Re.Id_Ruche=ruche.Id_Ruche WHERE ruche.id_rucher=$ID_Rucher";
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $poidstotal=$row['Poids'];
		  }
		  if ($poidstotal=='')
		  {
			  $poidstotal=0;
		  }
		  $template->assign('TotalRecolte',$poidstotal);
		  //Récolte par type de miel
		  $SQLS="SELECT SUM(Re.Poids) as Poids, T.Nom_Type_Miel FROM recolte Re INNER JOIN type_miel T ON T.Id_Type_Miel=Re.Id_Type_Miel INNER JOIN ruche Ru ON Re.Id_Ruche=Ru.Id_Ruche WHERE Ru.Id_rucher=$ID_Rucher GROUP BY Re.Id_Type_Miel";
		  $i=0;
		  $TabRecolte=array();
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $TabRecolte[$i]['NomType']=$row['Nom_Type_Miel'];
			  $TabRecolte[$i]['Poids']=$row['Poids'];
			  $i++;
		  }
		  $template->assign('ListeRecolte',$TabRecolte);
		  $template->display($CheminTpl.'stat_rucher.tpl');
	  }
	  else
	  {
		  //No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	  }
	  //On parse la page
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