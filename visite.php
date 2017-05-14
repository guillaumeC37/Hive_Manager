<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	visite.php										 *
 * Date création :													 *
 * Date Modification :	08/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Ajoute une visite à la ruche										 *
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
	if (isset($_SESSION['ID_Ruche']))
	{
		/********************************
		 * Attention, modification sur l'ajout de la maladie à prendre en compte !!!!!!!!!!!!!!!!!
		 Si on a [maladielist] => -1, alors ajouter d'abord [add_maladie] et récupérer son numéro d'ID !!
		 */
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$NumRuche=$_SESSION['ID_Ruche'];
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Nom_Ruche FROM ruche WHERE ID_Ruche=$NumRuche";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomRuche=$row['Nom_Ruche'];
		}
		if (isset($_POST['AddVisite']))  //on a recu une info du formulaire
		{
			//on enregistre la visite
			$Date_Visite=htmlspecialchars($_POST['dateVisite'],ENT_NOQUOTES,'UTF-8'); 
			$Date_Visite=convertDate($Date_Visite,0);
			if(isset($_POST['climat']))
			{
				$LeTemps=$_POST['climat'];
				if(filter_var( $LeTemps, FILTER_VALIDATE_INT) === false)
					$LeTemps=-1;
			}
			else
				$LeTemps=-1;
			if (isset($_POST['Hygro'])) 
			{
				$Hygro=htmlspecialchars($_POST['Hygro'],ENT_NOQUOTES,'UTF-8');
				if(filter_var( $Hygro, FILTER_VALIDATE_INT) === false)
					$Hygro='';
			}
			else
			{
				$Hygro='';
			}
			if (isset($_POST['temp']))  
			{
				$Temperature=htmlspecialchars($_POST['temp'],ENT_NOQUOTES,'UTF-8');
				if(filter_var($Temperature, FILTER_VALIDATE_FLOAT) === false)
					$Temperature='';
			}
			else
			{
				$Temperature='';
			}
			if (isset($_POST['poids']))  
			{
				$Poids=htmlspecialchars($_POST['poids'],ENT_NOQUOTES,'UTF-8');
				if(filter_var($Poids, FILTER_VALIDATE_FLOAT) === false)
					$Poids='';
				if ($Poids=='')
					$Poids=0;
			}
			else
			{
				$Poids=0;
			}
			if (isset($_POST['comportement']))
			{
				$Comportement=htmlspecialchars($_POST['comportement'],ENT_NOQUOTES,'UTF-8');
			}
			else
			{
				$Comportement='';
			}			
			if (isset($_POST['population']))  
			{
				$Population=htmlspecialchars($_POST['population'],ENT_NOQUOTES,'UTF-8');
			}
			else
			{
				$Population='';
			}
			 
			if (isset($_POST['reine'])) 
			{
				$Reine=1;
			}
			else
			{
				$Reine=0;
			}
			if (isset($_POST['maladie']))
			{
				$MaladiePresent=1;
				/* Attention, vérifier si maladielist ==-1, dans ce cas, il faut d'abord ajouter la maladie stockée dans [add_maladie] avant !!!!!!!!*/
				$Id_Maladie=$_POST['maladielist'];
				if(filter_var( $Id_Maladie, FILTER_VALIDATE_INT) === false)
					$Id_Maladie=-2;  //Provoquera une erreur
				if ($Id_Maladie==-1)
				{
					//On ajoute la maladie	et on récupère l'ID
					$NomNouvelle=htmlspecialchars($_POST['add_maladie'],ENT_NOQUOTES,'UTF-8');
					$SQLS="INSERT INTO maladie(Nom_Maladie,Id_Api) VALUES (:Nom_M,:ID_Api)";
					$ID_Api=$_SESSION['ID_API'];
					$TableTemp=array(':Nom_M'=>$NomNouvelle,':ID_Api'=>$ID_Api);
					$query=$DBConn->prepare($SQLS);
					$query->execute($TableTemp); 
					$count=$query->rowCount();
					if ($count==1)
					{
						$Id_Maladie=(int) $DBConn->lastInsertId();
					}
				}
			}
			else
			{
				$MaladiePresent=0;
				$Id_Maladie=(int)$_POST['maladielist'];
			}
			if (isset($_POST['nourissage'])) 
			{
				$Nourrissage=1;
				if (isset($_POST['nourrissage_text'])) 
				{
					$ValNourrissage=htmlspecialchars($_POST['nourrissage_text'],ENT_NOQUOTES,'UTF-8');
				}
				else
				{
					$ValNourrissage='';
				}
			}
			else
			{
				$Nourrissage=0;
				$ValNourrissage='';
			}
			if (isset($_POST['travaux'])) 
			{
				$Travaux=1;
			}
			else
			{
				$Travaux=0;
			}
			if (isset($_POST['notes']))
			{
				$Notes=htmlspecialchars($_POST['notes'],ENT_NOQUOTES,'UTF-8');
				$Notes=nl2br($Notes);
			}
			else
			{
				$Notes='';
			} 
			$MaTable=array(':Date_V'=>$Date_Visite,':Clim_V'=>$LeTemps,':Popu'=>$Population,':H_V'=>$Hygro,':T_V'=>$Temperature,':P_V'=>$Poids,':Comp'=>$Comportement,':Reine'=>$Reine,':Maladie'=>$MaladiePresent,':ID_M'=>$Id_Maladie,':Nourrissage'=>$Nourrissage,':Val_Nourr'=>$ValNourrissage,':Travaux'=>$Travaux,':Notes'=>$Notes,':ID_Ruche'=>$NumRuche);
			$SQLS="CALL P_Add_Visite(:Date_V,:Clim_V,:Popu,:H_V,:T_V,:P_V,:Comp,:Reine,:Maladie,:ID_M,:Nourrissage,:Val_Nourr,:Travaux,:Notes,:ID_Ruche)";
/*
echo "<p>$SQLS</p>";
echo "<pre>";
print_r($MaTable);
echo "</pre>";*/
			$query=$DBConn->prepare($SQLS);
			 //On ajoute à la base
	         $query->execute($MaTable); 
			 $count=$query->rowCount();
			 if ($count==1)
			 {
				$template->display($CheminTpl.'visite_ajoutee.tpl');
			 }
			 else
			 {
				$template->display($CheminTpl.'visite_erreur.tpl');
			 }
		}  //Fin on a récupérer un formulaire
		else
		{
			//Assigne le template 
			//Selection du climat
			$SQLS="select ID_TEMPS, NOM_TEMPS FROM temps_meteo ORDER BY NOM_TEMPS";
			$query=$DBConn->prepare($SQLS);
			$query->execute();
			$ListeMeteo=array();
			$i=0;
			while($data=$query->fetch())
			{
				$ListeMeteo[$i]['ID_TEMPS']=$data['ID_TEMPS'];
				$ListeMeteo[$i]['NOM_TEMPS']=$data['NOM_TEMPS'];
				$i++;
			}
			//Selection des maladies
			$ID_Api=$_SESSION['ID_API'];
			$SQLS="select idmaladie, Nom_Maladie FROM maladie WHERE Id_Api=$ID_Api ORDER BY Nom_Maladie";
			$query=$DBConn->prepare($SQLS);
			$query->execute();
			$ListeMaladie=array();
			$i=0;
			while($data=$query->fetch())
			{
				$ListeMaladie[$i]['idmaladie']=$data['idmaladie'];
				$ListeMaladie[$i]['Nom_Maladie']=$data['Nom_Maladie'];
				if ($data['Nom_Maladie']=='Aucune')
				{
					$ListeMaladie[$i]['selected']=' selected="selected"';
				}
				else
					$ListeMaladie[$i]['selected']='';
				$i++;
			}
			//Assignation du numéro de ruche au formulaire
			$template->assign('Nom_Ruche',$NomRuche);
			//Assignation des données de climat
			$template->assign('liste_meteo',$ListeMeteo);
			//Assignation des maladies
			$template->assign('liste_maladie',$ListeMaladie);
			//Affichage de la page
			$template->display($CheminTpl.'visite.tpl');
		}//Fin else on affiche juste la page
	} //Fin de if session id ruche existe
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