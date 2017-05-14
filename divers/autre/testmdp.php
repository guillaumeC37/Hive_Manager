<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
 "http://www.w3.org/TR/html4/loose.dtd">
<html  lang="fr-fr">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="content-type">
	</head>
	<body>
<?php
require("include/smarty.class.php");
include "include/config.inc.php";
include "include/function.inc.php";
$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
$SQLS="select MDP FROM apiculteur WHERE login='gcregut'";
$query=$DBConn->prepare($SQLS);
  $query->execute();
  while($data=$query->fetch())
  {
	  $Compte=$data['MDP'];
  }
  $Mot='MUSTANG';
  echo "<p>".$Compte."</p>";
  $Password=password_hash('MUSTANG',PASSWORD_DEFAULT);
  echo "<p>".$Password."</p>";
  if (password_verify('MUSTANG',$Compte))
  {
  echo  "<p>Mot de passe OK</p>";
  }
  else
  {
  echo "<p>Erreur</p>";
  }
    if (password_verify($Mot,$Password))
  {
  echo  "<p>Mot de passe OK</p>";
  }
  else
  {
  echo "<p>Erreur</p>";
  }
 ?>