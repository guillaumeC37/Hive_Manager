<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	datalogger.php									 *
 * Date création :													 *
 * Date Modification :	10/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * 		Vierge														 *
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
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/	
	if(isset($_SESSION['ID_API']))
	{
		$Id_Api=$_SESSION['ID_API'];
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		if(isset($_POST['NewDTL'])) //NewDTL
		{
			$Erreur=false;
			if(isset($_POST['NbreRec']))
			{
                $NbreHeures=$_POST['NbreRec'];
				$TabHeure=array();
                for ($i=1;$i<$NbreHeures+1;$i++)
                {
                        $Titre='Heure'.$i;
                        if(isset($_POST[$Titre]))
                        {
                                $Valeur=$_POST[$Titre];
                                $Heure=$Valeur;
                        }
                        $Titre='Minute'.$i;
                        if(isset($_POST[$Titre]))
                        {
                                $Valeur=$_POST[$Titre];
                                $Minute=$Valeur;
                        }
                        $TabHeure[$i]="$Heure:$Minute";
                }
			}
			else
			{
				$Erreur=true;
			}
			if(isset($_POST['LaRuche']))
			{
				$Id_Ruche=$_POST['LaRuche'];
				if(filter_var( $Id_Ruche, FILTER_VALIDATE_INT) === false)
					$Erreur=true;
			}
			else
			{
				$Erreur=true;
			}
			if($Id_Ruche==-1)
			{
				$Erreur=true;
			}
			$Capteur=0;
			if(isset($_POST['TempExt']))
			{
				$Capteur+=1;
			}
			if(isset($_POST['TempInt']))
			{
				$Capteur+=2;
			}
			if(isset($_POST['HygoExt']))
			{
				$Capteur+=4;
			}
			if(isset($_POST['HygroInt']))
			{
				$Capteur+=8;
			}
			if(isset($_POST['Poids']))
			{
				$Capteur+=16;
			}
			//Les capteurs sont représenté en binaire.
			if(($Capteur!=0) and (!$Erreur))
			{
				//On peut généré le fichier
				/*Ce qui compte :
				$Capteur
				$Id_Ruche
				$NbreHeures
				$TabHeure
				$VersionCourte
				*/
				//On traite la création du fichier
				//Si le fichier existe, on le supprime
				$Racine=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$Id_Api/temp/";
				$RacineHTML="documents/$Id_Api/temp/";
				$Fichier='conf.dtl';
				$Chemin=$Racine.$Fichier;
				if(!is_dir($Racine))
				{
					mkdir($Racine);
				}
				if(file_exists($Chemin))
				{
					unlink($Chemin);
				}
				$ChaineConf="#GRDTL;$VersionCourte;$Id_Ruche;$Capteur;$NbreHeures";
				foreach($TabHeure as $value)
				{
					$ChaineConf=$ChaineConf.";$value";
				}
				$ChaineConf=$ChaineConf."#";
				$FichierConf=fopen($Chemin,'w');
				$Ecrit=fwrite($FichierConf,$ChaineConf);
				fclose($FichierConf);
				if($Ecrit>0)
				{
					//Ecriture OK
					$Page='datalogger_ok.tpl';
					$template->assign('Lien',$RacineHTML.$Fichier);
				}
			} //Traitement OK des infos
			else
			{
				//Il a une erreur ou pas de capteurs.
				$Page='erreur_datalogger.tpl';
			}
			//On parse
			$template->display($Page);
		}
		else
		{
			//On récupère la liste de ruche de l'apiculteur
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb); //Connexion à la base de données
			$SQLS="SELECT Id_Rucher, Nom_Rucher FROM rucher WHERE ID_Apiculteur=$Id_Api ORDER BY nom_rucher";
			$TabRucher=array();
			$i=0;
			foreach($DBConn->query($SQLS) as $row)
			{
				$TabRucher[$i]['Id_Rucher']=$row['Id_Rucher'];
				$TabRucher[$i]['NomRucher']=$row['Nom_Rucher'];
				$i++;
			}
			$template->assign('ListeRucher',$TabRucher);
			$template->display($CheminTpl.'datalogger.tpl');
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