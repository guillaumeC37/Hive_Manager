<?php
require("include/smarty.class.php");
include "include/config.inc.php";
include "include/function.inc.php";
$template=new Smarty();
$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
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
 // print_r($ListeMeteo);
 $template->assign('liste_meteo',$ListeMeteo);
 $template->display('../templates/new2.tpl');
 ?>