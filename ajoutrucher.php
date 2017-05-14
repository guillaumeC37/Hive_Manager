<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	ajoutrucher.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Ajoute une rucher 												 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  $template=new Smarty();
  $CheminTpl='../templates/';
  //Est-on en session ?
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];
  }
  else
    $InSession=false;
  if ($InSession)
  {
	  if (isset($_SESSION['ID_API']))  //Si on est bien identifié
	  {
		  $TemplateUser=$_SESSION['Template_User'];
		  $template->assign('TemplateUser',$TemplateUser);
		  if (isset($_POST['AjoutRucher']))
		  {
			  $ID_API=$_SESSION['ID_API']; 
			  /*
			     On a recu ces valeurs dans POST. Ne pas oublier le Num Api dans la session
			     $_POST['rucheractif'];
                 $_POST['nomRucher'];
                 $_POST['localisation'];
                 $_POST['numero'];
			  */
			  if (isset($_POST['rucheractif']))
			  {
			     $IsActif=1;
			  }
			  else
			  {
				  $IsActif=0;
			  }
			  $LeNom=htmlspecialchars($_POST['nomRucher'],ENT_NOQUOTES,'UTF-8');
			  $LaLoc=htmlspecialchars($_POST['localisation'],ENT_NOQUOTES,'UTF-8');
			  $LeNum=htmlspecialchars($_POST['numero'],ENT_NOQUOTES,'UTF-8');
			  if (isset($_POST['coordonnees']))
			  {
				  $LesCoor=htmlspecialchars($_POST['coordonnees'],ENT_NOQUOTES,'UTF-8');
			  }
			  else
			  {
				  $LesCoor='';
			  }
			  if (isset($_POST['Obs']))
			  {
				  $LObs=htmlspecialchars($_POST['Obs'],ENT_NOQUOTES,'UTF-8');
				  $LObs=nl2br($LObs);
			  }
			  else
			  {
				  $LObs='';
			  }
			   /* Pour debug
	  echo "<pre> Session :";
	  print_r ($_POST);
	  echo "</pre>";  
	  */
			  //On vérifie si le rucher n'existe pas, par hasard...
			  $SQLS="SELECT count(*) AS Nombre FROM rucher WHERE ID_Apiculteur=$ID_API AND Num_Rucher='$LeNum'";
			  $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			  foreach($DBConn->query($SQLS) as $row)
			  {
				$Compte=$row['Nombre'];  
			  }
			  if ($Compte>0)
			  {
				//Le rucher existe déjà  
				$Page=$CheminTpl.'rucher_existe.tpl';
			  } 
			  else  //Le rucher n'existe pas
			  {
			    //On formate la requete
			    $Matable=array(':Api'=>$ID_API,':Actif'=>$IsActif,':Nom'=>$LeNom,':Loc'=>$LaLoc,':Numero'=>$LeNum,':Coord'=>$LesCoor,':Obs'=>$LObs);
			   /*Pour debug
	  echo "<pre> Session :";
	  print_r ($Matable);
	  echo "</pre>";  
	  */				
			    $SQLS="CALL P_Add_Rucher(:Api, :Actif,:Nom,:Loc,:Numero,:Coord,:Obs)";
			    $query=$DBConn->prepare($SQLS);
			    //On ajoute à la base
			    $query->execute($Matable);  
			    //On vérifie si elle existe
			    $SQLS="SELECT count(*) AS Nombre FROM rucher WHERE ID_Apiculteur=$ID_API AND Num_Rucher='$LeNum'";
			    $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			    foreach($DBConn->query($SQLS) as $row)
			    {
			   	  $Compte=$row['Nombre'];  
			    }
			    if ($Compte==1)
			    {
				  //Création OK  
				  $Page=$CheminTpl.'rucher_ajout.tpl';
			    } 
				else
				{
					//Erreur dans la création du rucher
					$Page=$CheminTpl.'rucher_erreur.tpl';
					
				}
			  }
			  $template->display($Page);
		  }  //Fin If ajout
		  else
		  {
			 //On arrive sur la page, sans être passé par le formulaire, donc on affiche le formulaire
			 $template->display($CheminTpl.'add_rucher.tpl');
		  }
	  }//fin de bien identifié
	  else
	  {
		  //Ici, on a un souci avec l'ID apiculteur, on break
		  $template->display($CheminTpl.'rucher_erreur.tpl');
	  }
  } //Fin de en session
  else  //On est arrivé sur la page alors qu'on ne devait pas y venir, car hors session
  {
	  $template->display($CheminTpl.'erreur.tpl');
  }//Fin de hors session
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
  