<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_hygro.php									 *
 * Date création :	18/05/2018										 *
 * Date Modification :	08/003/2017									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	0.2A												 *
 * Objet et notes :													 *
 *	Statistiques des relevés de l'hygrométrie en utilisant les		 *
 *	visites et le datalogger										 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  include "include/draw_single.php";
  $template=new Smarty(); 
//On verifie si on est dans la session
  $CheminTpl='../templates/';
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];
  }
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
		if(isset($_SESSION['ID_Ruche']))
		{
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
			$Id_Ruche=$_SESSION['ID_Ruche'];
			$Id_Api=$_SESSION['ID_API']; //On en a besoin pour la génération du fichier graphique
			$TemplateUser=$_SESSION['Template_User'];
			$template->assign('TemplateUser',$TemplateUser);
			//On affiche le nom de la ruche
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$Id_Ruche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$NomRuche=$row['Nom_Ruche'];  
			}
			$template->Assign('Ruche',$NomRuche);
			//As t'on donner les dates ?
			if(isset($_POST['Rech_temp']))
			{
				//On a les dates de recherches
				//On récupère la date la plus ancienne des visites de la ruche, peu importe si on a des mesures.
				$SQLS="SELECT MIN(Date_Visite) AS Min_Date from visite WHERE ID_Ruche=$Id_Ruche";
				foreach($DBConn->query($SQLS) as $row)
				{
					$MinDate=$row['Min_Date'];  
				}
				if ($MinDate=='')
				{
					//On parse une erreur car il n'y a pas eu de visite, donc pas de relevé.
					$Page=$CheminTpl.'no_hygro.tpl';
				}
				else
				{
					if (isset($_POST['DateDebut']))
					{
						$DateDebut=htmlspecialchars($_POST['DateDebut'],ENT_NOQUOTES,'UTF-8');
						if ($DateDebut!="")
						{
							$DateDebutAff=$DateDebut;
							$DateDebut=convertDate($DateDebut,0);
						}
						else
						{
							$DateDebut=$MinDate;
							$DateDebutAff=convertDate($DateDebut,1);
						}
					}
					else
					{
						
						$DateDebutAff=convertDate($MinDate,1);
						$DateDebut=$MinDate;
					}
					if (isset($_POST['DateFin']))
					{
						$DateFin=htmlspecialchars($_POST['DateFin'],ENT_NOQUOTES,'UTF-8');
						if($DateFin=="")
						{
							$DateFin=date('Y-m-d');
							$DateFinAff=date('d/m/Y');
						}
						else
						{
							$DateFinAff=$DateFin;
							$DateFin=convertDate($DateFin,0);
						}
					}
					else
					{
						$DateFinAff=$DateFin;
						$DateFin=convertDate($DateFin,0);
					}
					//Récupère le nombre de visite où la température a été renseignée et dans le créneau de date
					$SQLS="SELECT count(*) as Compte from visite WHERE HYGRO>0 AND ID_Ruche=$Id_Ruche AND Date_Visite BETWEEN '$DateDebut' AND '$DateFin'";
					$Compte=0;
					foreach($DBConn->query($SQLS) as $row)
					{
						$Compte=$row['Compte'];  
					}
					if ($Compte==0)
					{
						//Erreur, il n'y pas eu de visite valorisées entre ces dates
						$Page=$CheminTpl.'no_hygro.tpl';
					}
					else
					{
						//On peut rechercher
						//On envoie au taemplate les dates de début et de fin
						$template->assign('DateDebut',$DateDebutAff);
						$template->assign('DateFin',$DateFinAff);
						//On récupères les données des visites
						$SQLS="SELECT HYGRO,Date_Visite  from visite WHERE HYGRO>0 AND ID_Ruche=$Id_Ruche AND Date_Visite BETWEEN '$DateDebut' AND '$DateFin'";
						$i=0;
						$TabVisiteTemp=array();
						foreach($DBConn->query($SQLS) as $row)
						{
							$TabVisiteTemp[$i]['Date']=$row['Date_Visite'];
							$TabVisiteTemp[$i]['valeur']=$row['HYGRO'];
							$i++;
						}
						//On récupère les mesures du datalogger
						$SQLS="SELECT Date_log,HygroExt FROM datalogger WHERE ID_RUCHE=$Id_Ruche AND (Date_log BETWEEN '$DateDebut' AND '$DateFin') AND HygroExt>-100";
						$i=0;
						$TabDataLogTemp=array();
						foreach($DBConn->query($SQLS) as $row)
						{
							$TabDataLogTemp[$i]['Date']=$row['Date_log'];
							$TabDataLogTemp[$i]['valeur']=$row['HygroExt'];
							$i++;
						}
						//On fusionne les 2 tableaux en les triant par date
						$TabTotal=array_merge($TabVisiteTemp,$TabDataLogTemp);
						foreach ($TabTotal as $key => $row)
						{
							$Date[$key]  = $row['Date'];
							$Hygro[$key] = $row['valeur'];
						}
						array_multisort($Date,SORT_ASC,$Hygro,SORT_ASC,$TabTotal);
						//Génération du graphe
						$Titre="Relevé hygrométrique de la ruche '$NomRuche' sur la période du $DateDebutAff au $DateFinAff";
						$Racine=$_SERVER['DOCUMENT_ROOT']."/documents/$Id_Api/temp/";
						//Si jamais le répertoire n'existe pas (il est normalement créé à l'enregistrement de l'apiculteur sur le système
						if(!is_dir($Racine))
						{
							mkdir($Racine);
						}
						$Image='hygro.png';
						$Chemin=$Racine.$Image;
						//Si jamais le graphe existe, on le supprime
						if(file_exists($Chemin))
						{
							unlink($Chemin);
						}
						//On appelle la fonction de création du graphe		
						DrawGraph($DateDebut,$DateFin,$TabTotal,800,400,$Titre,$Chemin);
						$template->assign('graphique_temp',"$Id_Api/temp/".$Image);
						$Page=$CheminTpl.'stat_poids.tpl';
					}
				} //Fin else il y a une date minimum
				$template->display($Page);
			}
			//on a pas donner les dates, on affiche la page de données de dates
			else
			{
				if (isset($_SESSION['Date_Debut']))
				{
					//On prend des précautions avec les valeurs
					unset($_SESSION['Date_Debut']);
					unset($_SESSION['Date_Fin']);
				}
				$Page=$CheminTpl.'stat_ruche_rech_hygro.tpl';
				$template->display($Page);
			}
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