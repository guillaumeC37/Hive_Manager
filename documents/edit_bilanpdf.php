<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	edit_bilanpdf.php								 *
 * Date création :	03/03/2017										 *
 * Date Modification :	10/03/2017									 *
 * Créateur : Guillaume Crégut										 *													
 * Version : 0.2A													 *
 * Objet et notes :													 *
 *		Génère le pdf du bilan de la ruche							 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 session_start();
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/bilan_pdf.inc.php";
  include "../include/draw_Recoltebilan.php";
//On verifie si on est dans la session
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];
  }
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
		if (isset($_SESSION['ID_Ruche']))
		{
			$Id_Ruche=$_SESSION['ID_Ruche'];
			$Id_Api=$_SESSION['ID_API']; //On en a besoin pour la génération du fichier graphique
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			//répertoire des images
			$GraphDir=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$Id_Api/temp/bilan/";
			if(!is_dir($GraphDir))
			{
				mkdir($GraphDir);
			}
			else
			{
				$D=opendir($GraphDir);
				while ($e=readdir($D))
				{
					$fichier=$GraphDir.$e;
					if(is_file($fichier))
					{
						$i=unlink($fichier);
					}
				}
			}
			//On génères les autres infos que l'on place dans le pdf
			//Récupére les infos de la ruche
			$SQLS="SELECT Date_MES,NBRE_CADRE,NBRE_HAUSSE,NUM_RUCHE,Nom_Ruche,OBSERV,NOM_ETAT,Nom_Rucher,NOM_TYPE_RUCHE FROM vue_ruche_complete_sans_api WHERE ID_Ruche=$Id_Ruche";
			$TabInfo=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				$LaDate=$row['Date_MES'];
				if($LaDate!='')
					$TabInfo['DateMES']=convertDate($LaDate,1);
				else
					$TabInfo['DateMES']='';
				$TabInfo['NbreCadre']=$row['NBRE_CADRE'];
				$TabInfo['NbreHausse']=$row['NBRE_HAUSSE'];
				$TabInfo['NumRuche']=$row['NUM_RUCHE'];
				$TabInfo['NomRuche']=$row['Nom_Ruche'];
				$NomRuche=$row['Nom_Ruche'];
				$Observ=strip_tags($row['OBSERV']);
				$TabInfo['Obs']=$Observ;
				$TabInfo['NomEtat']=$row['NOM_ETAT'];
				$TabInfo['NomRucher']=$row['Nom_Rucher'];
				$TabInfo['TypeRuche']=$row['NOM_TYPE_RUCHE'];
			}
			$pdf= new EditielPDF('L');
			$pdf->AliasNbPages();
			$pdf->setAuthor('Editiel98');
			$pdf->setCreator('Gestion Rucher');
			$pdf->SetTitle( html_entity_decode('Bilan de la ruche'));
			$pdf->SetTitreDoc('Bilan de la ruche');
			$pdf->addPage();
			$SQLS="SELECT MIN(Date_Visite) AS Min_Date from visite WHERE ID_Ruche=$Id_Ruche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MinDate=$row['Min_Date'];  
			}
			if($MinDate=='')
			{
				//Il n'y a pas eu de visites, donc on arrete la pour la partie visite
				//affichage des infos de la ruche
				$pdf->SetInfoRuche($TabInfo);
			}
			else //On a une date minimum de visite, on peut traiter les graphes de visites
			{
				$dateDebut=convertDate($MinDate,1);
				$dateFin=date('d/m/Y');
				$pdf->Subtitle($dateDebut,$dateFin);
				//affichage des infos de la ruche
				$pdf->SetInfoRuche($TabInfo);
				$SQLS="SELECT SUM(Poids) as Poids FROM Vue_recolte_api  WHERE Id_Ruche=$Id_Ruche";
				foreach($DBConn->query($SQLS) as $row)
				{
					$PoidsTotal=$row['Poids'];
				}
				if($PoidsTotal=='')
				{
					$PoidsTotal=0;
				}
				//Récpuère par type de miel
				$SQLS="SELECT SUM(Poids) as Poids,Nom_Type_Miel FROM Vue_recolte_api  WHERE Id_Ruche=$Id_Ruche GROUP BY ID_Type_Miel";
				$i=0;
				$PoidsPartType=array();
				foreach($DBConn->query($SQLS) as $row)
				{
					$PoidsPartType[$i]['Poids_Miel']=$row['Poids'];
					$PoidsPartType[$i]['TypeMiel']=$row['Nom_Type_Miel'];
					$i++;
				}
				$pdf->SetRecoltes($PoidsTotal,$PoidsPartType);
				//mise en page des graphes de visite
						//Graphique de récoltes
				$SQLS="SELECT Date_R,Poids,Id_Type_Miel,Nom_Type_Miel,Image FROM Vue_recolte_api WHERE (ID_Ruche=$Id_Ruche) ORDER BY Date_R";
				$query=$DBConn->prepare($SQLS);
				$query->execute();
				$TabResultat=array();
				$i=0;
				while($data=$query->fetch())
				{
					$IdType=$data['Id_Type_Miel'];
					$TabResultat[$IdType][$i]['Date_R']=$data['Date_R'];
					$TabResultat[$IdType][$i]['LeNom']=$data['Nom_Type_Miel'];
					$TabResultat[$IdType][$i]['LePoids']=$data['Poids'];
					$TabResultat[$IdType][$i]['Image']=$data['Image'];
					$i++;
				}
				$Compte=count($TabResultat);
				if($Compte!=0)
				{
					$Titre="Relevé des récoltes de la ruche '$NomRuche'";
					$GrapheRecolte=$GraphDir.'recolte.png';
					if(file_exists($GrapheRecolte))
					{
						unlink($GrapheRecolte);
					}
					//$dateDebut,$dateFin 
					//On définit les dates de début et de fin du graphe
					$SQLS="SELECT MIN(Date_R) AS Min_Date from recolte WHERE ID_Ruche=$Id_Ruche";
					foreach($DBConn->query($SQLS) as $row)
					{
						$MinRec=$row['Min_Date'];
					}
					$SQLS="SELECT MAX(Date_R) AS Max_Date from recolte WHERE ID_Ruche=$Id_Ruche";
					foreach($DBConn->query($SQLS) as $row)
					{
						$MaxRec=$row['Max_Date'];
					}
					$DateGDebut=$MinRec;
					$DateGFin=$MaxRec;
					DrawGraph_Recolte($DateGDebut,$DateGFin,$TabResultat,800,400,$Titre,$GrapheRecolte,$Id_Api);
					$titre="Récolte de la ruche $NomRuche sur la période ".convertDate($DateGDebut,1).' - '.convertDate($DateGFin,1) ;
					$pdf->addPage();
					$pdf->Setgraphe($GrapheRecolte,$titre);
				}
		//Génération du graphe Température visite		
				$GrapheTempSuivi=$GraphDir.'tempvisite.png';
				//Combien de relevé on a ?
				$SQLS="SELECT count(*) as Compte from visite WHERE temperature>-100 AND ID_Ruche=$Id_Ruche";
				$Compte=0;
				foreach($DBConn->query($SQLS) as $row)
				{
					$Compte=$row['Compte'];
				}
				if ($Compte>0)
				{
					$pdf->addPage();
					$pdf->Subtitle($dateDebut,$dateFin);	
					//On recherche les valeurs et on créé le graphe
					$SQLS="SELECT temperature,Date_Visite  from visite WHERE temperature>-100 AND ID_Ruche=$Id_Ruche ORDER BY Date_Visite";
					$i=0;
					$TabVisiteTemp=array();
					foreach($DBConn->query($SQLS) as $row)
					{
						$TabVisiteTemp[$i]['Date']=$row['Date_Visite'];
						$TabVisiteTemp[$i]['valeur']=$row['temperature'];
						$i++;
					}
					$Titre="Relevé des températures de la ruche '$NomRuche'";
					//On supprime l'ancienne image, au cas où
					if(file_exists($GrapheTempSuivi))
					{
						unlink($GrapheTempSuivi);
					}
					//On appelle la fonction de création du graphe		
					DrawGraph_Single($MinDate,date('Y-m-d'),$TabVisiteTemp,800,400,$Titre,$GrapheTempSuivi);
					$titre="Relevé des températures de la ruche '$NomRuche' depuis les fiches de visite";
					$pdf->Setgraphe($GrapheTempSuivi,$titre);
				} 
		//Génération du graphe Poids visite			
				$GraphePoidsSuivi=$GraphDir.'poidsvisite.png';
				//Combien de relevé on a ?
				$SQLS="SELECT count(*) as Compte from visite WHERE POIDS>0 AND ID_Ruche=$Id_Ruche";
				$Compte=0;
				foreach($DBConn->query($SQLS) as $row)
				{
					$Compte=$row['Compte'];
				}
				if ($Compte>0)
				{	
					$pdf->addPage();
					$pdf->Subtitle($dateDebut,$dateFin);	
					//On recherche les valeurs et on créé le graphe
					$SQLS="SELECT POIDS,Date_Visite from visite WHERE POIDS>0 AND ID_Ruche=$Id_Ruche ORDER BY Date_Visite";
					$i=0;
					$TabVisitePoids=array();
					foreach($DBConn->query($SQLS) as $row)
					{
						$TabVisitePoids[$i]['Date']=$row['Date_Visite'];
						$TabVisitePoids[$i]['valeur']=$row['POIDS'];
						$i++;
					}
					$Titre="Relevé du poids de la ruche '$NomRuche'";
					//On supprime l'ancienne image, au cas où
					if(file_exists($GraphePoidsSuivi))
					{
						unlink($GraphePoidsSuivi);
					}
					//On appelle la fonction de création du graphe		
					DrawGraph_Single($MinDate,date('Y-m-d'),$TabVisitePoids,800,400,$Titre,$GraphePoidsSuivi);
					$titre="Relevé du poids de la ruche '$NomRuche' depuis les fiches de visite";
					$pdf->Setgraphe($GraphePoidsSuivi,$titre);
				}
		//Génération du grapheHygro visite
				$GrapheHygroSuivi=$GraphDir.'hygrovisite.png';
				//Combien de relevé on a ?
				$SQLS="SELECT count(*) as Compte from visite WHERE HYGRO>0 AND ID_Ruche=$Id_Ruche";
				$Compte=0;
				foreach($DBConn->query($SQLS) as $row)
				{
					$Compte=$row['Compte'];
				}
				if ($Compte>0)
				{	
					$pdf->addPage();
					$pdf->Subtitle($dateDebut,$dateFin);	
					//On recherche les valeurs et on créé le graphe
					$SQLS="SELECT HYGRO,Date_Visite from visite WHERE HYGRO>0 AND ID_Ruche=$Id_Ruche ORDER BY Date_Visite";
					$i=0;
					$TabVisiteHygro=array();
					foreach($DBConn->query($SQLS) as $row)
					{
						$TabVisiteHygro[$i]['Date']=$row['Date_Visite'];
						$TabVisiteHygro[$i]['valeur']=$row['HYGRO'];
						$i++;
					}
					$Titre="Relevé de l'hygrométrie de la ruche '$NomRuche'";
					if(file_exists($GrapheHygroSuivi))
					{
						unlink($GrapheHygroSuivi);
					}
					DrawGraph_Single($MinDate,date('Y-m-d'),$TabVisiteHygro,800,400,$Titre,$GrapheHygroSuivi);
					$titre="Relevé de l'hygrométrie de la ruche '$NomRuche' depuis les fiches de visite";
					$pdf->Setgraphe($GrapheHygroSuivi,$titre);		
				}
			}	//Fin des suivis
		//Relevé datalogger
				//Insère une page avec les informations datalogger
			$SQLS="SELECT min(Date_Log) as Minimum FROM datalogger WHERE ID_RUCHE=$Id_Ruche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MinDate=$row['Minimum'];
			}
			if($MinDate!='')
				$MinDateAff=ConvertDate($MinDate,1);
			else
				$MinDateAff='';
			$SQLS="SELECT max(Date_Log) as Maximum FROM datalogger WHERE ID_RUCHE=$Id_Ruche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MaxDate=$row['Maximum'];
			}
			if($MaxDate!='')
				$MaxDateAff=ConvertDate($MaxDate,1);
			else
				$MaxDateAff='';
				//On récupère d'autres informations sur les dataloggers
			$SQLS="SELECT DISTINCT ID_DataLogger FROM datalogger WHERE ID_RUCHE=$Id_Ruche";
			$i=0;
			$TabDataL=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				$TabDataL[$i]=$row['ID_DataLogger'];
			}
			$pdf->addPage();
			$pdf->InfosDataLogger($MinDateAff,$MaxDateAff,$TabDataL);
			//Récupération des valeurs moyennes
			$SQLS="SELECT AVG(Poids) as MoyPoids FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Poids>0)";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MoyPoids=$row['MoyPoids'];
			}
			$SQLS="SELECT AVG(TempInt) as MoyTempInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND ( TempInt>-100)";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MoyTempInt=$row['MoyTempInt'];
			}
			$SQLS="SELECT AVG(TempExt) as MoyTempExt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND ( TempExt>-100)";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MoyTempExt=$row['MoyTempExt'];
			}
			$SQLS="SELECT AVG(HygroInt) as MoyHygroInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND ( HygroInt>0)";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MoyHygroInt=$row['MoyHygroInt'];
			}
			$SQLS="SELECT AVG(HygroExt) as MoyHygroExt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND ( HygroExt>0)";
			foreach($DBConn->query($SQLS) as $row)
			{
				$MoyHygroExt=$row['MoyHygroExt'];
			}
			if(($MoyPoids!='') ||($MoyTempInt!='')|| ($MoyTempExt!='') ||($MoyHygroInt!='') ||($MoyHygroExt!=''))
			{
				$pdf->addPage();
				$pdf->Subtitle($dateDebut,$dateFin);
				//Affiche les moyennes
				$pdf->SetMoyennes(number_format($MoyPoids,2), number_format($MoyTempExt,2),number_format($MoyTempInt,2),number_format($MoyHygroExt,2),number_format($MoyHygroInt,2));
			}
			//Graphes du datalogger temperature
			//Récupère les infos
			$SQLS="SELECT Date_Log,Heure_Log,TempExt,TempInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND ( TempExt>-100 OR TempInt>-100) ORDER BY Date_Log,Heure_Log";
			$TabTemp=array();
			$i=0;
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
			$Compte=count($TabTemp);
			if ($Compte>0)
			{
				$pdf->addPage();
				$pdf->Subtitle($dateDebut,$dateFin);
				//On trace le graphe, et on l'affiche dans la page
				$GrapheDataLogTemp=$GraphDir.'templog.png';
				if(file_exists($GrapheDataLogTemp))
				{
					unlink($GrapheDataLogTemp);
				}
				$Titre="Relevé de température";
				$titre="Relevé des températures via le datalogger de la ruche '$NomRuche' entre le $MinDateAff et le $MaxDateAff";
				DrawGraph2Courbes($MinDate,$MaxDate,$TabTemp,600,400,$Titre,'température',$GrapheDataLogTemp);
				$pdf->Setgraphe($GrapheDataLogTemp,$titre);
			}
			//Graphes du datalogger hygro
			$SQLS="SELECT Date_Log,Heure_Log,HygroExt,HygroInt FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND ( HygroExt>0 OR HygroInt>0) ORDER BY Date_Log,Heure_Log";
			$i=0;
			$TabHygro=array();
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
			$Compte=count($TabHygro);
			if($Compte>0)
			{
				$pdf->addPage();
				$pdf->Subtitle($dateDebut,$dateFin);
				//On trace et on affiche
				$GrapheDataLogHygro=$GraphDir.'hygrolog.png';
				if(file_exists($GrapheDataLogHygro))
				{
					unlink($GrapheDataLogHygro);
				}
				$Titre='Relevé Hygrométrique';
				DrawGraph2Courbes($MinDate,$MaxDate,$TabHygro,600,400,$Titre,'hygrométrie',$GrapheDataLogHygro);
				$titre="Relevé de l'hygrométrie via le datalogger de la ruche '$NomRuche' entre le $MinDateAff et le $MaxDateAff";
				$pdf->Setgraphe($GrapheDataLogHygro,$titre);
			}
			//Graphes du datalogger poids
			$SQLS="SELECT Date_Log,Heure_Log,Poids FROM datalogger WHERE (ID_RUCHE=$Id_Ruche) AND (Poids>0) ORDER BY Date_Log,Heure_Log";
			$i=0;
			$TabPoids=array();
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
			$Compte=count($TabPoids);
			if($Compte>0)
			{
				$pdf->addPage();
				$pdf->Subtitle($dateDebut,$dateFin);
				//On trace le graphe et on l'affiche
				$GrapheDataLogPoids=$GraphDir.'poidslog.png';
				if(file_exists($GrapheDataLogPoids))
				{
					unlink($GrapheDataLogPoids);
				}
					$Titre="Relevé du poids";
				DrawGraph1Courbe($MinDate,$MaxDate,$TabPoids,600,400,$Titre,'Poids',$GrapheDataLogPoids);
				$titre="Relevé du poids via le datalogger de la ruche '$NomRuche' entre le $MinDateAff et le $MaxDateAff";
				$pdf->Setgraphe($GrapheDataLogPoids,$titre);
			}
				//Affichage PDF
			//}
			//
			$pdf->Output();
		}
		else
		{
			//No  man's land
			//On ne fait rien
		}
  }//Fin de on est dans la session
  else
  {
		require("../include/smarty.class.php");
		$template=new Smarty(); 
		$CheminTpl='../../templates/';
		$Page=$CheminTpl.'erreur.tpl';
		$template->display($Page);
		$Pied=new Smarty(); 
		$DBConn2=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Version'";
		foreach($DBConn2->query($SQLS) as $row)
		{
			$Version=$row['Value_Param'];  
		}
		$Pied->Assign('Version',$Version);
		$Pied->display('../templates/pied.tpl');
  }

?>  