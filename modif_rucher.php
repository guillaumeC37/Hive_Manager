<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	modif_rucher.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Modifie les infos du rucher										 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  $template=new Smarty(); 
  $CheminTpl='../templates/';
//On verifie si on est dans la session
  if (isset($_SESSION['InSession'])&&isset($_SESSION['ID_Rucher']))
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
	  echo "</pre>";  
	  */
	  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	  $Id_Rucher=$_SESSION['ID_Rucher'];
	  $TemplateUser=$_SESSION['Template_User'];
	  $template->assign('TemplateUser',$TemplateUser);
	  if (isset($_POST['ModifFaite']))  //As t'on recu une modification ?
	  {
			   /* Pour debug
	  echo "<pre> POST :";
	  print_r ($_POST);
	  echo "</pre>";  
	  */  
	    $C1=$_POST['C1'];
	    $C2=$_POST['C2'];
	    $C3=$_POST['C3'];
	    $C4=$_POST['C4'];
	    $C5=$_POST['C5'];
	    $C6=$_POST['C6'];
		$i=0;
		$SQLS=array();
		if($C1==1)
	    {
		  //On modifie le champs Nom
		  $Var=htmlspecialchars($_POST['NomR'],ENT_NOQUOTES,'UTF-8');
		  $Var=trim($Var);
		  $SQLS[$i]="UPDATE rucher SET Nom_Rucher='$Var' WHERE id_Rucher=$Id_Rucher";
		  $i++;
	    }
		if($C2==1)
	    {
		  //On modifie le champs Num
		  $Var=htmlspecialchars($_POST['NumR'],ENT_NOQUOTES,'UTF-8');
		  $Var=trim($Var);
		  $SQLS[$i]="UPDATE rucher SET Num_Rucher='$Var' WHERE id_Rucher=$Id_Rucher";
		  $i++;
	    }
		if($C3==1)
	    {
		  //On modifie le champs Actif
		  if (isset($_POST['Activ']))  //case cochée
		  {
			$Var=1;
		  }
		  else  //case non cochée
		  {
			$Var=0;  
		  }
		  $SQLS[$i]="UPDATE rucher SET isActif=$Var WHERE id_Rucher=$Id_Rucher";
		  $i++;
	    }
		if($C4==1)
	    {
		  //On modifie le champs Localisation
		  $Var=htmlspecialchars($_POST['LocR'],ENT_NOQUOTES,'UTF-8');
		  $Var=trim($Var);
		  $SQLS[$i]="UPDATE rucher SET Localisation='$Var' WHERE id_Rucher=$Id_Rucher";
		  $i++;
	    }
		if($C5==1)
	    {
		  //On modifie le champs Coord
		  $Var=htmlspecialchars($_POST['CoordR'],ENT_NOQUOTES,'UTF-8');
		  $Var=trim($Var);
		  $SQLS[$i]="UPDATE rucher SET Coordonnees_GPS='$Var' WHERE id_Rucher=$Id_Rucher";
		  $i++;
	    }
		if($C6==1)
	    {
		  //On modifie le champs Observ.
		  $Var=htmlspecialchars($_POST['observations'],ENT_NOQUOTES,'UTF-8');
		  $Var=nl2br($Var);
		  $Var=trim($Var);
		  $SQLS[$i]="UPDATE rucher SET Observations='$Var' WHERE id_Rucher=$Id_Rucher";
	    }
		//On execute les requetes contenus dans la table
		$count=0;
		$i=count($SQLS);
		for($j=0;$j<$i;$j++)
		{
		  $query=$SQLS[$j];
		  $count+=$DBConn->exec($query);
		}
		/*debug
		echo "<pre>";
		print_r($SQLS);
		echo "</pre>";
		*/
		if ($count==$i)
		{
			$Page=$CheminTpl.'mrucherOK.tpl';
		}
		else  //y'a eu un souci
		{
			$Page=$CheminTpl.'mrucherfailed.tpl';
		}
		$template->display($Page);
	  }	  
	  else  //On a pas fait de modifications
	  {
	    $SQLS="SELECT Nom_Rucher, Localisation,Num_Rucher,IsActif, Coordonnees_GPS,Observations, Nom_Api,Prenom_Api FROM Vue_Rucher_Api WHERE Id_Rucher=$Id_Rucher";
	    foreach($DBConn->query($SQLS) as $row)
	    {
		  $NomRucher=$row['Nom_Rucher'];
		  $NumRucher=$row['Num_Rucher'];
		  $Actif=$row['isActif'];
		  $Loc=$row['Localisation'];
		  $Coord=$row['Coordonnees_GPS'];
		  $Obs=$row['Observations'];
		  //Il faut supprimer les <br> des observations !!!
		  $Obs=strip_tags($Obs);
		  $Identite=$row['Prenom_Api']." ".$row['Nom_Api'];		
	    }
	  //Gestion actif
	    if($Actif==1)// Rucher actif
		{
		     $ImageRucher='checked="checked"';
		}
		else  //Rucher inactif
		{
		   	  $ImageRucher="";
		}
	  //On parse la page
	    $template->assign('Nom_prenom',$Identite);
	    $template->assign('NomRucher',$NomRucher);
	     $template->assign('NumRucher',$NumRucher);
	    $template->assign('Actif',$ImageRucher);
	    $template->assign('Loc',$Loc); 
	    $template->assign('GPS',$Coord);
	    $template->assign('Observations',$Obs);
	    $Page=$CheminTpl.'modif_rucher.tpl';
	    $template->display($Page);
	  }
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