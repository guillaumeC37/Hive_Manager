<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	signIn.php										 *
 * Date création :													 *
 * Date Modification :	10/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Permet l'inscription d'un apiculteur								 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
require("include/smarty.class.php");
include "include/config.inc.php";
include "include/function.inc.php";
$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
if (isset($_POST['newApi']))
{
/*
  MD5 du mot de passe
  
  vérifier les infos html 
  afficher enfin un lien vers l'accueil si enregistrement OK
*/
	//On enregistre l'utilisateur
  $template=new Smarty();	
  $CheminTpl='../templates/';
  //Ici on bloque les tentatives de fraudes et on gère les accents pour la base de données (pas question de stocker des caractère html dedans).
  $Nom =  htmlspecialchars($_POST['nom'], ENT_NOQUOTES, "UTF-8");
  $Prenom= htmlspecialchars($_POST['prenom'],ENT_NOQUOTES,'UTF-8');
  $Login= htmlspecialchars($_POST['login'],ENT_NOQUOTES,'UTF-8');
  $Password= htmlspecialchars($_POST['pass1'],ENT_NOQUOTES,'UTF-8');
  $Numero= htmlspecialchars($_POST['adresse']);
  if(filter_var( $Numero, FILTER_VALIDATE_INT) === false)
	  $Numero='';
  $TypeRue= htmlspecialchars($_POST['voie']);
  if(filter_var( $TypeRue, FILTER_VALIDATE_INT) === false)
	  $TypeRue=-1;
  $NomRue= htmlspecialchars($_POST['nomvoie'],ENT_NOQUOTES,'UTF-8');
  $CP= htmlspecialchars($_POST['cp']);
  if(filter_var( $CP, FILTER_VALIDATE_INT) === false)
	  $CP='';
  $NomVille= htmlspecialchars($_POST['ville'],ENT_NOQUOTES,'UTF-8');
  $NumAGRIT= htmlspecialchars($_POST['numagrit'],ENT_NOQUOTES,'UTF-8');
  $NAPI= htmlspecialchars($_POST['napi'],ENT_NOQUOTES,'UTF-8');
  $ID_Question=$_POST['Listequestion'];
  if(filter_var( $ID_Question, FILTER_VALIDATE_INT) === false)
	  $ID_Question=-1;
  $ReponseQ=htmlspecialchars($_POST['reponse'],ENT_NOQUOTES,'UTF-8');
  if (isset($_POST['siret']))
  {
	 $Siret=htmlspecialchars($_POST['siret'],ENT_NOQUOTES,'UTF-8');
  }
  else
  {
	  $Siret=='';
  }
  if (isset($_POST['ape']))
  {
	 $APE=htmlspecialchars($_POST['ape'],ENT_NOQUOTES,'UTF-8');
  }
  else
  {
	  $APE='';
  }
  if (isset($_POST['mail']))
  {
	 $Mail=htmlspecialchars($_POST['mail'],ENT_NOQUOTES,'UTF-8');
  }
  else
  {
	  $Mail='';
  }
  /*Ordre d'ajout dans la procédure stockée
  $Login
  $Password
  $APE
  $NAPI
  $Siret
  $NumAGRIT
  $Nom
  $Prenom
  $NomVille
  $Numero
  $NomRue
  $CP
  $TypeRue
  $Mail
  $IDQuestion
  $Reponse
*/
//Vérification de l'existence ou non de l'apiculteur
  $SQLS2="SELECT count(*) AS NOMBRE FROM apiculteur WHERE Nom_Api='".$Nom."' AND Prenom_Api='".$Prenom."' AND NUMAGRI='".$NumAGRIT."';";
  $query2=$DBConn->prepare($SQLS2);
  $query2->execute();
  $Compte=0;
  while($data=$query2->fetch())
  {
	  $Compte=$data['NOMBRE'];
  }
  if ($Compte>=1)  //l'apiculteur existe déjà
  {
	 //$PopupAjout="onload=\"alert('Ajout effectu&eacute;')\"";
	 $Page=$CheminTpl.'api_existe.tpl';
  } 
  else
  {  
//on créé la fiche
  //hashage du mot de passe pour stockage
    //$Password=md5($Password); Plus recommandé.
	//hashage en SH128
	$Password= hash('sha512',($SelHash.$Password));
	//génération de la table de liaison SQL
    $Matable=array(':Login'=>$Login,':Password'=>$Password,':APE'=>$APE,':NAPI'=>$NAPI,':Siret'=>$Siret,':NumAGRIT'=>$NumAGRIT,':Nom'=>$Nom,':Prenom'=>$Prenom,':NomVille'=>$NomVille,':Numero'=>9,':NomRue'=>$NomRue,':CP'=>$CP,':TypeRue'=>$TypeRue,':Mail'=>$Mail,':idquestion'=>$ID_Question,':reponse'=>$ReponseQ);
    $SQLS='CALL P_Add_Api(:Login, :Password,:APE,:NAPI,:Siret,:NumAGRIT,:Nom,:Prenom,:NomVille,:Numero,:NomRue,:CP,:TypeRue,:Mail,:idquestion, :reponse)';
    $query=$DBConn->prepare($SQLS);
    $query->execute($Matable);
    $SQLS2="SELECT count(*) AS NOMBRE FROM apiculteur WHERE Nom_Api='".$Nom."' AND Prenom_Api='".$Prenom."' AND NUMAGRI='".$NumAGRIT."';";
    $query2=$DBConn->prepare($SQLS2);
    $query2->execute();
    $Compte=0;
    while($data=$query2->fetch())
    {
  	    $Compte=$data['NOMBRE'];
    }
    if ($Compte==1)
    {
		//$PopupAjout="onload=\"alert('Ajout effectu&eacute;')\"";
		//On ajoute la maladie "Aucune" au nouvel apiculteur ->Evite un bug dans Visite car une maladie doit exister.
		$SQLS="SELECT ID_Apiculteur FROM apiculteur WHERE Nom_Api='".$Nom."' AND Prenom_Api='".$Prenom."' AND NUMAGRI='".$NumAGRIT."';";
		$query=$DBConn->prepare($SQLS);
		$query->execute();
		while($data=$query->fetch())
		{
			$ID_ApiC=$data['ID_Apiculteur'];
		}
		$SQLS="INSERT INTO maladie(Id_Api,Nom_Maladie) VALUES($ID_ApiC,'Aucune')";
		$query2=$DBConn->prepare($SQLS);
		$query2->execute();
		//On créé le template par defaut
		$SQLS="INSERT INTO param(Nom_Param,Value_Param,ID_Apiculteur) VALUES('Template','default',$ID_ApiC)";
		$query2=$DBConn->prepare($SQLS);
		$query2->execute();
		//On créé le repertoire temporaire
		$Racine=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$Id_Api/temp/";
		mkdir($Racine);
		$Page=$CheminTpl.'api_ajout.tpl';
    } 
	else
	{
		$Page=$CheminTpl.'api_erreur.tpl';
	}
  }//Fin de else existe
  //On affiche la page
    $template->display($Page);
}  //Fin d'ajout d'un apiculteur
else
{
	//Sinon on affiche la page d'enregistrement
  $template=new Smarty(); 
	//Selection du type de voie
  $SQLS="select Id_Type, Nom_Type FROM type_voie ORDER BY Nom_Type";  
  $query=$DBConn->prepare($SQLS);
  $query->execute();
  $ListeVoies=array();
  $i=0;
  while($data=$query->fetch())
  {
    $ListeVoies[$i]['Id_Type']=$data['Id_Type'];
	$LeType=htmlspecialchars_decode($data['Nom_Type']);
    $ListeVoies[$i]['Nom_Type']=$LeType;//$data['Nom_Type'];
    $i++;
  }
   $template->assign('liste_voies',$ListeVoies);
  //Question secrete
  $SQLS="SELECT ID_Question, Nom_Question FROM question_secrete ORDER BY Nom_Question";
  $i=0;
  $ListeQuestion=array();
  foreach($DBConn->query($SQLS) as $row)
  {
	  
	  $ListeQuestion[$i]['Id_Q']=$row['ID_Question'];
	  $ListeQuestion[$i]['Nom_Q']=$row['Nom_Question'];
	  $i++;
  }
  $template->assign('liste_question',$ListeQuestion);
  $template->display($CheminTpl.'apiculteur.tpl');
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