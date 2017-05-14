<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	modif_ruche.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * modifie les infos de la ruche									 *
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
  //A t'on recu une info POST de modification
  if (isset($_POST['Mod_Ruche']))
  {
/* Pour debug
echo "<pre> Session :";
print_r ($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";  
*/	
		//On execute la mise à jour
		if (isset($_SESSION['ID_Ruche']))
		{
			$Id_Ruche=$_SESSION['ID_Ruche'];
			$Erreur=0;
			//On récupère les valeurs
			if (isset($_POST['NomRuche']))
			{
				$NomRuche=htmlspecialchars($_POST['NomRuche'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Erreur=1;
			
			if (isset($_POST['NumRuche']))
			{
				$NumRuche=htmlspecialchars($_POST['NumRuche'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Erreur=1;
			if (isset($_POST['rucher_aff']))
			{
				$IdRucher=(int)$_POST['rucher_aff'];
			}
			else
				$Erreur=1;
			if (isset($_POST['DateCrea']))
			{
				$DateC=htmlspecialchars($_POST['DateCrea'],ENT_NOQUOTES,'UTF-8');
				$DateC=convertDate($DateC,0);
			}
			else
				$DateC='';
			if (isset($_POST['Etat']))
			{
				$IdEtat=$_POST['Etat'];
				if(filter_var( $Etat, FILTER_VALIDATE_INT) === false)
				{
					$Etat=-1;//provoquera une erreur d'insertion, normal, car cela veut dire que l'index n'est pas valide
				}
			}
			else
				$Erreur=1;
			if (isset($_POST['Hausses']))
			{
				$Hausses=$_POST['Hausses'];
				if(filter_var( $Hausses, FILTER_VALIDATE_INT) === false)
				{
					$Erreur=1;//provoquera une erreur d'insertion, normal, car cela veut dire que l'index n'est pas valide
				}
			}
			else
				$Erreur=1;
			if (isset($_POST['Obs']))
			{
				$Obs=htmlspecialchars($_POST['Obs'],ENT_NOQUOTES,'UTF-8');
				$Obs=nl2br($Obs);
			}
			else
				$Obs='';
			if($Erreur==0)
			{
				$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
				$TableValeur=array(':Nom'=>$NomRuche,':Num'=>$NumRuche,':Rucher'=>$IdRucher,':DateC'=>$DateC,':Etat'=>$IdEtat,':Hausse'=>$Hausses,':Observation'=>$Obs,':IdRuche'=>$Id_Ruche);
				//On prépare la requete
				$SQLS="CALL P_Update_Ruche(:Nom,:Num,:Rucher,:DateC,:Etat,:Hausse,:Observation,:IdRuche)";
				$query=$DBConn->prepare($SQLS);
				//Execute la requete
				$query->execute($TableValeur); 
				//Compte le nombre de lignes modifiées
				$count=$query->rowCount();
				if($count==1)
				{
					$Page=$CheminTpl.'mod_ruche_ok.tpl';   //OK
				}
				else
				{
					$Page='../templates/mod_ruche_fail.tpl';  //pas OK
				}
			}//Fin if erreur=0
			else
			{
				//Erreur dans la récupération des données, on ne traite pas.
				$Page=$CheminTpl.'mod_ruche_fail.tpl';
			}
		}//Fin if Session ID_ruche
		else
		{
			//No man's Land
			$Page=$CheminTpl.'erreur_rucher.tpl';
		}
		$template->display($Page);
  }//fin on a recu un truc de POST
  else
  {  //On a pas recu d'info POST
	  if (isset($_SESSION['ID_Ruche']))
	  {
		  $Id_Ruche=$_SESSION['ID_Ruche'];
		  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		  //Récupère les infos de la ruche
		  $SQLS="SELECT Date_MES,NBRE_CADRE,NBRE_HAUSSE,NOM_TYPE_RUCHE, NUM_RUCHE,Nom_Ruche,OBSERV,Nom_Rucher,type_cadre FROM vue_ruche_complete_sans_api WHERE ID_Ruche=$Id_Ruche";
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $LaDate=$row['Date_MES'];
			  $NbreCadre=$row['NBRE_CADRE'];
			  $NbreHausse=$row['NBRE_HAUSSE'];
			  $NumRuche=$row['NUM_RUCHE'];
			  $NomRuche=$row['Nom_Ruche'];
			  $OBSERV=$row['OBSERV'];
			  //Il faut supprimer les <br> de observations !!
			  $OBSERV=strip_tags($OBSERV);
			  $NomRucher=$row['Nom_Rucher'];
			  $TypeHausse=$row['type_cadre'];
			  $TypeRuche=$row['NOM_TYPE_RUCHE'];
		  }
		  //Mise en forme de la date
		  if ($LaDate=='0000-00-00')
		  {
			$LaDate=''; 
		  }
		  else
		  {
			$LaDate=convertDate($LaDate,1);  
		  }
		  $template->assign('Nom_Ruche',$NomRuche);
		  $template->assign('Nom_Rucher',$NomRucher);
		  $template->assign('Date_Ruche',$LaDate);
		  $template->assign('Num_Ruche',$NumRuche);
		  $template->assign('NbreHausses',$NbreHausse);
		  $template->assign('NomType',$TypeRuche);
		  $template->assign('NomHausse',$TypeHausse);
		  $template->assign('NbreCadres',$NbreCadre);
		  $template->assign('Obs',$OBSERV);
		  //Selectionne l'idEtat de la rucher et id rucher
		  $SQLS="SELECT id_rucher, ID_ETAT FROM ruche WHERE ID_Ruche=$Id_Ruche";
		  foreach($DBConn->query($SQLS) as $row)
		  {
			$ID_Rucher=$row['id_rucher'];
			$ID_Etat=$row['ID_ETAT'];
		  }
		  $SQLS="SELECT ID_ETAT, NOM_ETAT FROM etat_ruche ORDER BY NOM_ETAT";
		  $ListeEtat=array();
		  $i=0;
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $ListeEtat[$i]['ID_E']=$row['ID_ETAT'];
			  $ListeEtat[$i]['Nom_E']=$row['NOM_ETAT'];
			  if ($row['ID_ETAT']==$ID_Etat)
			  {
				$ListeEtat[$i]['IsSelect']='selected="selected" ';  
			  }
			  else
				  $ListeEtat[$i]['IsSelect']='';
			  $i++;
		  }
		  $template->assign('liste_Etat',$ListeEtat);
		  //Infos des ruchers
		  $SQLS="SELECT id_Rucher, Nom_Rucher FROM rucher ORDER BY Nom_Rucher";
		  $ListeRucher=array();
		  $i=0;
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $ListeRucher[$i]['ID_R']=$row['id_Rucher'];
			  $ListeRucher[$i]['Nom_R']=$row['Nom_Rucher'];
			  if ($row['id_Rucher']==$ID_Rucher)
			  {
				$ListeRucher[$i]['IsSelect']='selected="selected" ';  
			  }
			  else
				  $ListeRucher[$i]['IsSelect']='';
			  $i++;
		  }
		  $template->assign('liste_Rucher',$ListeRucher);
		  $template->display($CheminTpl.'modif_ruche.tpl');
	  }
	  else
	  {
		  //No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	  }
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