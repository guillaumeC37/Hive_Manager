<?php
//Connexion à la base
  $userdb="happy2";
  $passdb="happy2";
  $servdb="localhost";
  $basedb="test";
  $DBConn=connectbase($userdb,$passdb,$servdb,$basedb);
//Récupération des infos de la table
  $SQLS="SELECT * FROM jsontest";
  $query=$DBConn->prepare($SQLS);
  $query->execute();
//Récup le nombre de ligne de retour de la BDD
//Créer un tableau avec les valeurs
  $tab=array();
//vérifier Nbre ligne>0
//While row=fetch_assoc()
  $i=0;
  while($data=$query->fetch())
  {
	  $tab[$i]['nom']=$data['nom'];
	  $tab[$i]['prenom']=$data['prenom'];
	  $tab[$i]['age']=$data['age'];
	  $i++;
  }
  header('Content-Type:application/json');
  $toto=json_encode(array('students'=>$tab));
  echo $toto;
 function connectbase($user,$pass,$serveur,$base)
{
	$temp=new PDO('mysql:host='.$serveur.';dbname='.$base,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	return $temp;
}
?>