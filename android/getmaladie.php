<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 		Page de gestion android										 *
 * Nom de la page :	getmaladie.php									 *
 * Date création :	09/05/2017										 *
 * Date Modification :	13/05/2017 									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	1.1B												 *
 * Objet et notes :													 *
 *		Recoit en POST le token, vérifie si OK						 *
 *	Et renvoie en JSON la liste des maladies						 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  include "../include/config.inc.php";
  include "../include/function.inc.php";
//On verifie si on est dans la session
 // On recherche le token dans la BDD avec ID +token en get, et on regarde le timestamp et la validité. Si TS<now, validité=0, et on annule la demande. Il faut se relogger
//Je sais pas si les sessions fonctionneront 

/*
En Debug, vérifier si on recoit bien le POST token....
*/
$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
$tokenOK=false;
$ID_Api=0;
$LePOST=print_r($_POST,true);
if (isset($_POST['token']))
{
	$TokenEnCours=htmlspecialchars($_POST['token'],ENT_NOQUOTES,'UTF-8');
	$TokenEnCours=trim($TokenEnCours);
	//On récupère les infos du token
	$SQLS="SELECT Etat_Token, Timeout, ID_Api FROM android_table WHERE Token='$TokenEnCours'";
	$query=$DBConn->prepare($SQLS);
	$query->execute();
	while($data=$query->fetch())
	{
		$ID_Api=$data["ID_Api"];
		$LeTimeOut=$data["Timeout"];
		$LEtat=$data["Etat_Token"];
	}
	//echo "ID :$ID_Api, Etat : $LEtat, Timeout : $LeTimeOut";
	//Le token est fini, on envoie une fin de non recevoir
	if ($LEtat==0)
	{
		http_response_code(401); //Normalement c'est 401
		exit;
	}
	//Vérification du timeout du token 
	$Maintenant=new DateTime("now");
	$DateToken=new DateTime($LeTimeout);
	$Peremption=$Maintenant<$DateToken;
	if ($Peremption)
	{
		$TokenOk=true;
	}
	else
	{
		$SQLS="UPDATE android_table SET Etat_Token=0 WHERE Token=$LeToken";
		$query=$DBConn->prepare($SQLS);
		$query->execute();
		http_response_code(401); //Normalement c'est 401
		exit;
	}
}
 if($tokenOK)
 {	 
	
	$SQLS="SELECT COUNT(*) as Nbre FROM maladie WHERE Id_Api=$ID_Api";
	$query=$DBConn->prepare($SQLS);
	$query->execute();
	$Nbre=0;
	while($data=$query->fetch())
	{
		 $Nbre=$data['Nbre'];
	}
	if ($Nbre>0)
	{
		$SQLS="select Nom_Maladie FROM maladie WHERE Id_Api=$ID_Api ORDER BY Nom_Maladie";
		$TabMaladie=array();
		$i=0;
		$query=$DBConn->prepare($SQLS);
		$query->execute();
		while($data=$query->fetch())
		{
			$TabMaladie[$i]["Nom"]=$data["Nom_Maladie"];
			$i++;
		}
		header('Content-Type:application/json');
		$JsonMaladie=json_encode(array('Maladies'=>$TabMaladie));
		echo $JsonMaladie;
		
	}
	else
	{
		http_response_code(404); //Pas de données
		/*$TabMaladie[0]["Nom"]="ID API :$ID_Api";
		$JsonMaladie=json_encode(array('Maladies'=>$TabMaladie));
		echo $JsonMaladie;*/
	}
	  //On parse la page
  }//Fin de on est dans la session (if true)
  else
  {
	  //On est pas dans la session
	  http_response_code(401); //Erreur d'authentification
	/* $TabMaladie[0]["Nom"]=$LePOST;
		$JsonMaladie=json_encode(array('Maladies'=>$TabMaladie));
		echo $JsonMaladie;*/
  }
?>  