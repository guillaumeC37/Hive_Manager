<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_datalogger.php								 *
 * Date création :	07/03/2017										 *
 * Date Modification :	10/03/2017									 *
 * Créateur : Guillaume Crégut										 *													
 * Version : 0.2A													 *
 * Objet et notes :													 *
 *		Récupères les données du datalogger	pour statisiques		 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  include "include/drawDatalog.php";
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
		if (isset($_SESSION['ID_Ruche']))
		{
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb); 
			$Id_Api=$_SESSION['ID_API'];
			$Id_Ruche=$_SESSION['ID_Ruche'];
			$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$Id_Ruche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$NomRuche=$row['Nom_Ruche'];  
			}
			if(isset($_POST['Rech_data']))
			{
				//Traiter les informations en provenances des dates
				//Date de début
				$MinDate='';
				if (isset($_POST['DateDebut']))
				{
					//On met en forme 
					$MinDate=htmlspecialchars($_POST['DateDebut'],ENT_NOQUOTES,'UTF-8');
				}
				if($MinDate!='')
					$MinDate=convertDate($MinDate,0);
				else
				{
					//On récupère la date minimum dans la base
					$SQLS="SELECT min(Date_Log) as Minimum FROM datalogger WHERE ID_RUCHE=$Id_Ruche";
					foreach($DBConn->query($SQLS) as $row)
					{
						$MinDate=$row['Minimum']; 
					}
				}
				//Date de fin
				if (isset($_POST['DateFin']))
				{
					//On met en forme 
					$MaxDate=htmlspecialchars($_POST['DateFin'],ENT_NOQUOTES,'UTF-8');
					if($MaxDate!='')
						$MaxDate=convertDate($MaxDate,0);
					else
						$MaxDate=date('Y-m-d');
				}
				else
				{
					//Si pas de jour de fin, c'est donc aujourd'hui
						$MaxDate=date('Y-m-d'); 
				}
				//Mise en forme des dates affichées en francais
				if ($MinDate=='')
				{
					$template->display($CheminTpl.'nostat_datalogger.tpl');
				}
				else
				{
					$DateDebutAff=convertDate($MinDate,1);
					$DateFinAff=convertDate($MaxDate,1);
					$TabTemp=array();
					$TabPoids=array();
					$TabHygro=array();
					$i=0;
					//Calcul des statistiques
					//Poids
					$SQLS="SELECT AVG(Poids) as MoyPoids FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND (Poids>0)";
					foreach($DBConn->query($SQLS) as $row)
					{
						$Moy=$row['MoyPoids'];
						
					}
					if ($Moy=='')
						$Moy=0;
					$template->assign('MoyPoids',number_format($Moy,2));
					//Temperature Int
					$SQLS="SELECT AVG(TempInt) as MoyTempInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND ( TempInt>-100)";
					foreach($DBConn->query($SQLS) as $row)
					{
						$Moy=$row['MoyTempInt'];
						
					}
					if ($Moy=='')
						$Moy=0;
					$template->assign('MoyTempInt',number_format($Moy,2));
					//Temperature Ext
					$SQLS="SELECT AVG(TempExt) as MoyTempExt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND ( TempExt>-100)";
					foreach($DBConn->query($SQLS) as $row)
					{
						$Moy=$row['MoyTempExt'];
					}
					if ($Moy=='')
						$Moy=0;
					$template->assign('MoyTempExt',number_format($Moy,2));
					//Hygro int
					$SQLS="SELECT AVG(HygroInt) as MoyHygroInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND ( HygroInt>0)";
					foreach($DBConn->query($SQLS) as $row)
					{
						$Moy=$row['MoyHygroInt'];
					}
					if ($Moy=='')
						$Moy=0;
					$template->assign('MoyHygroInt',number_format($Moy,2));
					//Hygro ext
					$SQLS="SELECT AVG(HygroExt) as MoyHygroExt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND ( HygroExt>0)";
					foreach($DBConn->query($SQLS) as $row)
					{
						$Moy=$row['MoyHygroExt'];
					
					}
					if ($Moy=='')
						$Moy=0;
					$template->assign('MoyHygroExt',number_format($Moy,2));
				//Selectionne les températures >-100
					$SQLS="SELECT Date_Log,Heure_Log,TempExt,TempInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND ( TempExt>-100 OR TempInt>-100) ORDER BY Date_Log,Heure_Log";
					foreach($DBConn->query($SQLS) as $row)
					{
						$LaDate=explode('-',$row['Date_Log']);
						$Lheure=explode(':',$row['Heure_Log']);
						$LeTimeStamp=mktime($Lheure[0],$Lheure[1],$Lheure[2],$LaDate[1],$LaDate[2],$LaDate[0]);					
						$TabTemp[$i]['LaDate']=$LeTimeStamp;
						if($row['TempExt']==-100)
						{
							$T_Ext='';
						}
						else
							$T_Ext=$row['TempExt'];	
						$TabTemp[$i]['Valeur_Ext']=$T_Ext;
						if($row['TempInt']==-100)
						{
							$T_Int='';
						}
						else
							$T_Int=$row['TempInt'];	
						$TabTemp[$i]['Valeur_Int']=$T_Int;					
						$i++;
					}
					//Selectionne les données hygro >0
					$SQLS="SELECT Date_Log,Heure_Log,HygroExt,HygroInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND ( HygroExt>0 OR HygroInt>0) ORDER BY Date_Log,Heure_Log";
					$i=0;
					foreach($DBConn->query($SQLS) as $row)
					{
						$LaDate=explode('-',$row['Date_Log']);
						$Lheure=explode(':',$row['Heure_Log']);
						$LeTimeStamp=mktime($Lheure[0],$Lheure[1],$Lheure[2],$LaDate[1],$LaDate[2],$LaDate[0]);
						$TabHygro[$i]['LaDate']=$LeTimeStamp;
						if($row['HygroExt']==0)
							$H_Ext='';
						else
							$H_Ext=$row['HygroExt'];
						$TabHygro[$i]['Valeur_Ext']=$H_Ext;
						if($row['HygroInt']==0)
							$H_Int='';
						else
							$H_Int=$row['HygroInt'];
						$TabHygro[$i]['Valeur_Int']=$H_Int;
						$i++;
					}
					//Selectionne les poids >0
					$SQLS="SELECT Date_Log,Heure_Log,Poids FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Date_Log BETWEEN '$MinDate' AND '$MaxDate') AND (Poids>0)  ORDER BY Date_Log,Heure_Log";
					$i=0;
					foreach($DBConn->query($SQLS) as $row)
					{
						$LaDate=explode('-',$row['Date_Log']);
						$Lheure=explode(':',$row['Heure_Log']);
						$LeTimeStamp=mktime($Lheure[0],$Lheure[1],$Lheure[2],$LaDate[1],$LaDate[2],$LaDate[0]);
						$TabPoids[$i]['LaDate']=$LeTimeStamp;
						if($row['Poids']==0)
							$Poids='';
						else
							$Poids=$row['Poids'];
						$TabPoids[$i]['Valeur']=$Poids;
						$i++;
					}
					//Définition des fichiers png
					$Racine=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$Id_Api/temp/";
					$GraphePoids='datalog_poids.png';
					$GrapheTemp='datalog_temp.png';
					$GrapheHygro='datalog_hygro.png';
					//On vérifie si le répertoire existe, sinon, il est créé
					if(!is_dir($Racine))
					{
						mkdir($Racine);
					}
					//Suppression des fichiers si ils existent
					$Chemin=$Racine.$GraphePoids;
					if(file_exists($Chemin))
					{
						unlink($Chemin);
					}
					$Chemin=$Racine.$GrapheTemp;
					if(file_exists($Chemin))
					{
						unlink($Chemin);
					}
					$Chemin=$Racine.$GrapheHygro;
					if(file_exists($Chemin))
					{
						unlink($Chemin);
					}
					$BaseHTML="documents/$Id_Api/temp/";
					//On dessine les graphes
					$Titre="Relevé de temperature de la ruche $NomRuche entre le $DateDebutAff et le $DateFinAff";
					if(count($TabTemp)>0)
					{
						DrawGraph2Courbes($MinDate,$MaxDate,$TabTemp,600,400,$Titre,'température',$Racine.$GrapheTemp);
						$Image2=$BaseHTML.$GrapheTemp;
					}
					else
						$Image2='images/nodata.png';
					$Titre="Relevé hygrométrique de la ruche $NomRuche entre le $DateDebutAff et le $DateFinAff";
					if(count($TabHygro)>0)
					{
						DrawGraph2Courbes($MinDate,$MaxDate,$TabHygro,600,400,$Titre,'hygrométrie',$Racine.$GrapheHygro);
						$Image3=$BaseHTML.$GrapheHygro;
					}
					else
						$Image3='images/nodata.png';
					$Titre="Relevé de Poids de la ruche $NomRuche entre le $DateDebutAff et le $DateFinAff";
					if(count($TabPoids)>0)
					{
						DrawGraph1Courbe($MinDate,$MaxDate,$TabPoids,600,400,$Titre,'Poids',$Racine.$GraphePoids);
						$Image1=$BaseHTML.$GraphePoids;
					}
					else
						$Image1='images/nodata.png';
					//On parse la page
					$template->assign('DateDebut',$DateDebutAff);
					$template->assign('DateFin',$DateFinAff);
					$template->assign('Ruche',$NomRuche); 
					$template->assign('ImagePoids',$Image1);
					$template->assign('ImageTemp',$Image2);
					$template->assign('ImageHygro',$Image3);
					$template->display($CheminTpl.'stat_datalogger.tpl');
				}
			}
			else
			{
				//On affiche le selecteur de date.
				if (isset($_SESSION['Date_Debut']))
				{
					//On prend des précautions avec les valeurs
					unset($_SESSION['Date_Debut']);
					unset($_SESSION['Date_Fin']);
				}
				$template->Assign('Ruche',$NomRuche);
				$Page=$CheminTpl.'stat_ruche_rech_data.tpl';
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