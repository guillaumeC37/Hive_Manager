<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 		Page de gestion android										 *
 * Nom de la page :	login.php										 *
 * Date création :	27/03/2017										 *
 * Date Modification : 11/05/2017									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.1B												 *
 * Objet et notes :		Récupère les infos de login de l'appareil	 *
 *	 Retourne un token (à 0 si erreur identification)				 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  include "../include/config.inc.php";
  include "../include/function.inc.php";
//On verifie si on est dans la session
//
/* 
On recherche le token dans la BDD avec ID +token en get, et on regarde le timestamp et la validité. Si TS<now, validité=0, et on annule la demande. Il faut se relogger

  */
	  //Connexion à la base de données
	  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	  //Initialisation
	  $MonToken=0;
	  $ID_Apiculteur=0;
	  $TokenOk=false;
	  //Vérifier et purger les token

	  //On vérifie si le token renvoyé est OK
	  if (isset($_POST['token']))
	  {
		  //On vérifie dans la base si le token est actif
		  $LeToken=htmlspecialchars($_POST['token'],ENT_NOQUOTES,'UTF-8');
		 
		  $LeToken=trim($LeToken);
		  if($LeToken!="0")
		  {
			$SQLS="SELECT ID_Api,Etat_Token,Timeout FROM android_table WHERE Token=$LeToken";
			$query=$DBConn->prepare($SQLS);
			$query->execute();
			//On récupère les infos
			while ($data=$query->fetch())
			{
				$ID_Apiculteur=$data['ID_Api'];
				$Etat_token=$data['Etat_Token'];
				$Timeout=$data['Timeout'];
			}
			//Vérifier l'état du token et sa péremption
			$Maintenant=new DateTime("now");
			$DateToken=new DateTime($Timeout);
			$Peremption=$Maintenant<$DateToken;
			if ($Peremption)
			{
				$TokenOk=true;
				$MonToken=$LeToken;
			}
			else
			{
				$TokenOk=false;
				$SQLS="UPDATE android_table SET Etat_Token=0 WHERE Token=$LeToken";
				$query=$DBConn->prepare($SQLS);
				$query->execute();
			}
			if($Etat_token==0)
			{
				$TokenOk=false;
			}
		  }	
		  //On retourne le token
		  
	  }
	  if (!$TokenOk)
	  {
	  //Ensuite on tente la connexion
	  
		if (isset($_POST["login"]))  //On a saisi un login et un mot de passe
		{	
			$login=htmlspecialchars($_POST["login"],ENT_NOQUOTES,'UTF-8');
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
				$MonToken=0;
			}
			$Password= hash('sha512',($SelHash.$Password));
			if ($Password==$MDP)
			{
				//L'apiculteur est bien connecté et identifié.
				//On verifie la version 
				$Version_Android=$_POST['version'];
				$VersionOk=verifVersion($Version_Android,$userdb,$passdb,$servdb,$nomdb);
				if($VersionOk)
				{					
					//Création du token
					$MonToken=$ID_Apiculteur.time();
					//Récupération du timestamp pour la BDD	
					$MonTS=date('Y-m-d H:i:s',(time()+3600)); //1heure de validité du token
					$SQLS="insert into android_table (ID_Api,Token,Etat_Token,Timeout) VALUES ($ID_Apiculteur,$MonToken,1,'$MonTS')";
					$query=$DBConn->prepare($SQLS);
					$query->execute();
				}
			}

		} //Fin isset login
	  } //Fin Not token OK
	  echo $MonToken;
  
?>  