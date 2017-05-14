<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_rucher.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Voir les informations du rucher									 *
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
	  if (isset($_POST['id_rucher']))
	  {
		//On récupère les données
		$Id_Rucher=(int)$_POST['id_rucher'];
		$_SESSION['ID_Rucher']=$Id_Rucher;
	  }//Fin de test présence ID_Rucher dans post
	  else
	  {
		  //Pas d'Id Rucher soit on est arrivé par là sans passer par la selection du rucher, soit elle est dans la session
		  if (isset($_SESSION['ID_Rucher']))
		  {
			$Id_Rucher=$_SESSION['ID_Rucher'];
		  }//fin de récupération ID dans session
		  else
		  {
            //On est ici dans la session, mais l'ID n'est pas valide....
			$Id_Rucher=0;
		  }	
	  }	  
	  if ($Id_Rucher>0)
	  {
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		//On récupère les données
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Nom_Rucher, Num_Rucher, isActif FROM Rucher WHERE ID_Rucher=".$Id_Rucher;
		foreach($DBConn->query($SQLS) as $row)
	    {
		    $NomRucher=$row['Nom_Rucher'];
		    $NumRucher=$row['Num_Rucher'];
		    $Actif=$row['isActif'];
	    }
	    $template->assign('NomRucher',$NomRucher);
		$template->assign('NumRucher',$NumRucher);
		if($Actif==1)// Rucher actif
		{
		   $ImageRucher="check";
		}
		else  //Rucher inactif
		{
			$ImageRucher="mort";
		}
		$template->assign('EtatRucher',$ImageRucher);
		//On met en forme les ruches
		$SQLS="SELECT ID_Ruche,Nom_Ruche,EPHOTO,TPHOTO FROM vue_ruche_complete_sans_api WHERE Id_Rucher=$Id_Rucher ORDER BY Nom_Ruche";
		$LesRuches=array();
	    $i=0;
		foreach($DBConn->query($SQLS) as $row)
		{
			$LesRuches[$i]['ID_R']=$row['ID_Ruche'];
			$LesRuches[$i]['Nom_R']=$row['Nom_Ruche'];
			$P1=$row['EPHOTO'];
			$P2=$row['TPHOTO'];
			$LesRuches[$i]['Photo']=$P2.$P1;
			$i++;
		}
		//On met en forme la page  
		//On parse la page
		$template->assign('liste_ruche',$LesRuches);
		$Page=$CheminTpl.'voir_rucher.tpl';
	  }  //fin de if on est dans le rucher
	  else
	  { //On est pas dans le rucher
	    $Page=$CheminTpl.'erreur_rucher.tpl';
	  }
	  //On parse la page
	  $template->display($Page);
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