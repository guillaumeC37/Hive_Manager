<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	index.php										 *
 * Date création :													 *
 * Date Modification :	10/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * page d'accueil													 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
session_start();
require("include/smarty.class.php");
include "include/config.inc.php";
include "include/function.inc.php";
$template=new Smarty(); 
$CheminTpl='../templates/';
//Gestion des sessions
//temporaire, à traiter avec les sessions
//On verifie la version

$CanDisplay=true;
if (isset($_SESSION['InSession']))
{
	$InSession=$_SESSION['InSession'];
}
else
  $InSession=false;	
$PopupAjout='';
if (isset($_POST['logout']))
{
	$InSession=false;
	$PopupAjout=" onload=\"alert('Session correctement terminee')\"";
	if (isset($_SESSION))
    {
      unset($_SESSION);
      session_destroy();
    }
}
//On verifie si les versions sont OK avant tout
$VersionOk=verifVersion($Version_Soft,$userdb,$passdb,$servdb,$nomdb);
if ($VersionOk)
{
  if (isset($_POST["login"]))  //On a saisi un login et un mot de passe
  {
	  $InSession=false;  //On réinitialise la session, voir avec moteur de session
	  $ID_Apiculteur=0;
	  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	  $login=htmlspecialchars($_POST["login"],ENT_NOQUOTES,'UTF-8');
	  //Protege d'une usurpation SQL
//$login=$DBConn->quote($login); //Plante si on utilise la préparation

	  $SQLS="SELECT ID_Apiculteur, MDP FROM apiculteur WHERE login=:login";
      $MaTable=array(':login'=>$login);
      $query=$DBConn->prepare($SQLS);
      $query->execute($MaTable);
      $MDP='';
      while($row=$query->fetch())
      {
		$MDP=$row['MDP'];
		$ID_Apiculteur=$row['ID_Apiculteur'];
	  }
	  if (isset($_POST["pass"]))
	  {
		 $Password=$_POST["pass"];
	  }
	  else
	  {
		  $Password='';
	  }
	  //$Password=md5($Password);  Non recommandé
	  $Password= hash('sha512',($SelHash.$Password));
	  if ($Password==$MDP)
	  {
		//L'apiculteur est bien connecté et identifié.
		 $_SESSION['InSession']=true;
		  $_SESSION['ID_API']=$ID_Apiculteur;
		  $InSession=true;
		  //Vidage du répertoire temporaire
		  $Document=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$ID_Apiculteur/temp/";
		  $D=opendir($Document);
		  while ($e=readdir($D))
		  {
			$fichier=$Document.$e;
			if(is_file($fichier))
			{
				$i=unlink($fichier);
			}
		  }
		  //On vérifie si un nouveau template n'a pas été ajouté
		  $SQLS="SELECT Nom_Template FROM Templates ORDER BY Nom_Template";
		  $TabSQL=array();
		  foreach($DBConn->query($SQLS) as $row)
		  {
			 array_push($TabSQL,$row['Nom_Template']); 
		  }
		  $Rep=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/style";
		  $D=opendir($Rep);
		  rewinddir($D);
		  while ($e=readdir($D))
		  {
			$item=$Rep.'/'.$e;
			if(is_dir($item) and ($e!='.') and($e!='..'))
			{
				if(!in_array($e,$TabSQL))
				{
					$SQLS="INSERT INTO Templates (Nom_Template) VALUES ('$e')";
					$DBConn->query($SQLS);
				}
			}
		  }
	  }	 
      else
	  {
		  $PopupAjout=" onload=\"alert('Erreur de login ou de mot de passe')\"";
		  $InSession=false;
		  $ID_Apiculteur=0;
	  }
	
  }  
}
else
{
  $InSession=false;
  $CanDisplay=false;
  $PopupAjout="Erreur de version";
}	
if($InSession)  //La session est ouverte, on a donc l'ID et le by Pass
{	
  if (isset($_SESSION['ID_API']))
  {
	//On arrive sur ici soit parce que l'on est en session et on a cliquer sur index, soit après le login
	$ID_Apiculteur=$_SESSION['ID_API'];
    
    $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	if (!(isset($_SESSION['Template_User'])))
	{
	//On selectionne le template de l'utilisateur
		$SQLS="SELECT Value_Param FROM param WHERE ID_Apiculteur=$ID_Apiculteur and Nom_Param='Template'";
		foreach($DBConn->query($SQLS) as $row)
		{
			$TemplateUser=$row['Value_Param'];
		}
		$_SESSION['Template_User']=$TemplateUser;
	}
	else
		$TemplateUser=$_SESSION['Template_User'];
	//Récupère le nom de l'apiculteur
	$SQLS="SELECT Nom_Api,Prenom_APi FROM apiculteur where ID_Apiculteur=$ID_Apiculteur";
    foreach($DBConn->query($SQLS) as $row)
    {
      $NomApiculteur=$row['Nom_Api'];
      $PrenomApiculteur=$row['Prenom_APi'];
    }	
	//Récupère les ruchers de l'apiculteur
	$SQLS="SELECT id_Rucher, Nom_Rucher,IsActif FROM rucher WHERE ID_Apiculteur=$ID_Apiculteur";
	$LeRucher=array();
	$i=0;
	foreach($DBConn->query($SQLS) as $row)
    {
      $LeRucher[$i]['ID_RUCHER']=$row['id_Rucher'];
      $LeRucher[$i]['NOM_RUCHER']=$row['Nom_Rucher'];
	  $isActif=$row['IsActif'];
	  if ($isActif==0)
	  {
		  $LeRucher[$i]['Image']='rucher_dead';
	  }
      else
	  {
          $LeRucher[$i]['Image']='rucher';
	  }  
	  $i++;
    }	
	//Préparation de l'affichage
	$template->assign('liste_rucher',$LeRucher);
	//Affiche les ruchers de l'apiculteur
	
    //Prépare l'affichage des noms
    $template->assign('PrenomApiculteur',$PrenomApiculteur);
    $template->assign('NomApiculteur',$NomApiculteur);
  //Affiche la page
    $template->display($CheminTpl.'accueil.tpl');
  }//Fin de if ID existe
  else  //ID Apiculteur n'existe pas dans la session
  {
	$PopupAjout="Erreur système : 1";
	$InSession=false;
	$template->assign('Ajout',$PopupAjout);
    $template->display($CheminTpl.'index.tpl');
  }
}  //Fin In Session
else  //On est pas dans la session
{
  if($CanDisplay)
  {
	$template->assign('NomLogiciel',$NomProduit);
	$template->assign('Ajout',$PopupAjout);
	$template->display($CheminTpl.'index.tpl');
  }
  else
  {
	$template->assign('VersionBase',$Version_Soft);
	$template->display($CheminTpl.'erreur_version.tpl');
  }
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