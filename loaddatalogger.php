<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	loaddatalogger.php								 *
 * Date création :	06/03/2017										 *
 * Date Modification :	11/03/2017									 *
 * Créateur : Guillaume Crégut										 *													
 * Version : 0.2A													 *
 * Objet et notes :													 *
 *	Charge les informations contenu dans un ficher dtl				 *
 *	Dans la base de données											 *
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
	if(isset($_SESSION['ID_API']))
	{
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
		$Id_Api=$_SESSION['ID_API'];
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		if (isset($_POST['FileLoaded']))
		{
			//Chargement du fichier
			$Racine=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$Id_Api/temp/";
			$Erreur=false;
			if (isset($_FILES['datalogger']))
			{
				if($_FILES['datalogger']['error']==0)
				{
					//On a bien un fichier, on vérifie si c'est bien fichier xml
					$Fichier=$_FILES['datalogger']['tmp_name'];
					$TypeFichier=mime_content_type ( $Fichier);
					if(!($TypeFichier=="application/xml"))
					{
						$Erreur=true;
					}
				}
				else
					$Erreur=true;
			}
			else
				$Erreur=true;
			if($Erreur==false)
			{
				$NomFichier='datalog.dtl';
				$CheminComplet=$Racine.$NomFichier;
				//Si le fichier existe, on le supprime
				if(file_exists($CheminComplet))
				{
					unlink($CheminComplet);
				}
				//On copie le fichier dans le répertoire qui va bien
				if(move_uploaded_file($_FILES['datalogger']['tmp_name'],$CheminComplet))	
				{
					//On peut traiter le xml
					$Datalogger=simplexml_load_file($CheminComplet);
					$VersionDL=$Datalogger->version;
					if($VersionCourte==$VersionDL)
					{
						$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
						$IdDL=$Datalogger->idDatalogger;
						$ID_Ruche=$Datalogger->idruche;
						//echo "<p>Version : $VersionDL<br>Ruche : $ID_Ruche<br>Datalogger : $IdDL</p>";
						$ListeMesures=$Datalogger->mesures;
						$CompteTotal=0;
						foreach($ListeMesures->mesure as $Mesure)
						{
							$LaDate=convertDate($Mesure->DateMesure,0);
							$Heure=$Mesure->HeureMesure;
							$Temp_E=$Mesure->TempExt;
							$Temp_I=$Mesure->TempInt;
							$Hygro_E=$Mesure->HygroExt;
							$Hygro_I=$Mesure->HygroInt;
							$Poids=$Mesure->Poids;
							$MaTable=array(':ID_datalogger'=>$IdDL,':DateLog'=>$LaDate,':HeureLog'=>$Heure,':Poids'=>$Poids,':TempExt'=>$Temp_E,':TempInt'=>$Temp_I,':HygroExt'=>$Hygro_E,':HygroInt'=>$Hygro_I,':ID_Ruche'=>$ID_Ruche,':ID_Api'=>$Id_Api);
							$SQLS="call P_Add_Datalogger_Info(:ID_datalogger,:DateLog,:HeureLog,:Poids,:TempExt,:TempInt,:HygroExt,:HygroInt,:ID_Ruche,:ID_Api)";
							$query=$DBConn->prepare($SQLS);
							$query->execute($MaTable);
							//Compte le nombre de ligne OK
							$Compte=$query->rowcount();
							$CompteTotal+=$Compte;		
						}
						$template->assign('NbreLignes',$CompteTotal);
						$template->display($CheminTpl.'loaddtl_ok.tpl');
					}
					else
					{
						//Erreur de version du datalogger
						//On affiche les versions
						$template->assign('VerDTL',$VersionDL);
						$template->assign('VerSys',$VersionCourte);
						$template->display($CheminTpl.'err_ver_dtl.tpl');
					}
				}
				else
				{
					//Il y a eu une erreur de copie de fichier
					$Page=$CheminTpl.'erreur.tpl';
					$template->display($Page);
				}
			}
			else
			{
				//Il y a eu une erreur dans le fichier téléchargé.
				$Page=$CheminTpl.'erreur.tpl';
				$template->display($Page);
			}
		}
		else
		{
			$Page=$CheminTpl.'loaddatalogger.tpl';
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