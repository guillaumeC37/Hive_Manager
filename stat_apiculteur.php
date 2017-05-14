<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_apiculteur.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * affiche les statistiques de récoltes de l'apiculteur				 *
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
		if (isset($_SESSION['ID_API']))
		{
			$ID_API=$_SESSION['ID_API'];
			$TemplateUser=$_SESSION['Template_User'];
			$template->assign('TemplateUser',$TemplateUser);
			//affiche les ruchers et le nombre de ruchees dedans
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb); //Connexion à la base de données
			$SQLS="SELECT Rucher.Nom_Rucher,count(ruche.id_ruche) as NbreRuche FROM rucher Left JOIN ruche On ruche.id_rucher=rucher.id_rucher WHERE rucher.ID_Apiculteur=$ID_API GROUP BY rucher.id_rucher"; 
			$Liste_Ruche=array();
			$i=0;
			foreach($DBConn->query($SQLS) as $row)
			{
				$Liste_Ruche[$i]['Nom']=$row['Nom_Rucher'];
				$Liste_Ruche[$i]['Qtte']=$row['NbreRuche'];
				$i++;
			}
			$template->assign('liste_rucher',$Liste_Ruche);
			//Récupère la liste des ruchers de l'apiculteur			
			$SQLS="SELECT id_Rucher,Nom_Rucher FROM rucher WHERE ID_Apiculteur=$ID_API ORDER BY Nom_Rucher";
			$i=0;
			$ListeRucher=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				$ListeRucher[$i]['Nom']=$row['Nom_Rucher'];
				$ListeRucher[$i]['Id']=$row['id_Rucher'];
				$i++;
			}
			$template->assign('ListeRucher',$ListeRucher);
			//récupération des récoltes de l'apiculteur
			$SQLS="SELECT SUM(Poids) as Poids, Nom_Type_Miel FROM Vue_recolte_api WHERE Id_Apiculteur=$ID_API GROUP BY Id_Type_Miel";
			$ListeRecolte=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				$ListeRecolte[$i]['Nom']=$row['Nom_Type_Miel'];
				$ListeRecolte[$i]['Poids']=$row['Poids'];
				$i++;
			}
			$template->assign('ListeRecolte',$ListeRecolte);
			$template->display($CheminTpl.'stat_api.tpl');
		}
		else
		{
			//No man's land
			$Page=$CheminTpl.'erreur_rucher.tpl';
			$template->display($Page);
		}
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
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