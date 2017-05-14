<?php
//Vérification des [POST]
//Insertion d'après les infos recu dans POST
  $nom='';
  $prenom='';
  $age='';
  if (isset($_POST['nom']))
  {
	  $nom=$_POST['nom'];
  }
  if (isset($_POST['prenom']))
  {
	  $prenom=$_POST['prenom'];
  }
  if (isset($_POST['age']))
  {
	  $age=$_POST['age'];
  }
  if (($nom!=''&&$prenom!=''&&$age!=''))
  {
	  //Connexion à la base
	$userdb="happy2";
	$passdb="happy2";
	$servdb="localhost";
	$basedb="test";
	$DBConn=connectbase($userdb,$passdb,$servdb,$basedb);
	$SQLS='INSERT INTO jsontest (nom, prenom, age) VALUES ('."'$nom','$prenom','$age')";
	$query=$DBConn->prepare($SQLS);
	$query->execute();
	if ($query->rowcount()!=1)
	{
		http_response_code(400);
	}
	else
	{
		//http_response_code(204);
		echo "OK";
	}
  }	
  else
  {
	  http_response_code(400);
  }
  function connectbase($user,$pass,$serveur,$base)
{
	$temp=new PDO('mysql:host='.$serveur.';dbname='.$base,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	return $temp;
}
?>