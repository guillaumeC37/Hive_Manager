<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	ajout_ruche.php									 *
 * Date création :													 *
 * Date Modification :	11/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Ajoute une ruche au rucher										 *
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
	  //On récupère l'ID Rucher
	  if (isset($_SESSION['ID_Rucher']))
	  {
	    $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$Id_Rucher=$_SESSION['ID_Rucher'];
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		//On regarde si on a poster un truc
	    if(isset($_POST['Add_Ruche']))  //On a ajouter
	    {

		/*
			NOM=>$_POST['nom']
			NUM=>$_POST['num']
			Nombre de cadre=>$_POST['NbreCadre']
			Type de ruche=>$_POST['typeRuche']
			Type de Hausse=>$_POST['thausse']
			Nombre de hausse=>  $_POST['nbrehausse']
			Etat=>$_POST['etatRuche']
			ID_Rucher=>/
			date=>$_POST['dateMES']
			Observations=>$_POST['Obs']
			*/
			$LeNom=htmlspecialchars($_POST['nom'],ENT_NOQUOTES,'UTF-8');
			$LeNum=htmlspecialchars($_POST['num'],ENT_NOQUOTES,'UTF-8');
			//On vérifie d'abord si une ruche existe déjà avec ces paramètres
			$ID_Api=$_SESSION['ID_API'];
			$SQLS="SELECT count(*) AS Nombre from vue_ruche_api WHERE NUM_RUCHE='$LeNum' AND Nom_Ruche='$LeNom' AND ID_Apiculteur=$ID_Api";
			//On vérifie si la ruche existe déjà pour l'apiculteur
			foreach($DBConn->query($SQLS) as $row)
			{
				$Compte=$row['Nombre'];  
			}
			if ($Compte>0)
			{
				//Le rucher existe déjà  
				$Page=$CheminTpl.'ruche_existe.tpl';
			} 
			else // On peut ajouter la ruche
			{
			  $LeNbreC=$_POST['NbreCadre'];
			  if(filter_var( $LeNbreC, FILTER_VALIDATE_INT) === false)
			  {
					$LeNbreC=0; 
			  }
			  $LeTypeR=$_POST['typeRuche'];
			  if(filter_var( $LeTypeR, FILTER_VALIDATE_INT) === false)
			  {
					$LeTypeR=-1; //provoquera une erreur d'insertion, normal, car cela veut dire que l'index n'est pas valide
			  }
			  $LeTypeH=$_POST['thausse'];
			  if(filter_var( $LeTypeH, FILTER_VALIDATE_INT) === false)
			  {
					$LeTypeH=-1; //provoquera une erreur d'insertion, normal, car cela veut dire que l'index n'est pas valide
			  }
			  $LeNbreH=$_POST['nbrehausse'];
			  if(filter_var( $LeNbreH, FILTER_VALIDATE_INT) === false)
			  {
					$LeNbreH=0;
			  }
			  $Etat=$_POST['etatRuche'];
			  if(filter_var( $Etat, FILTER_VALIDATE_INT) === false)
			  {
					$Etat=-1;//provoquera une erreur d'insertion, normal, car cela veut dire que l'index n'est pas valide
			  }
			  if (isset($_POST['dateMES']))
			  {
			  	  $LaDate=htmlspecialchars($_POST['dateMES'],ENT_NOQUOTES,'UTF-8');
				  $LaDate=convertDate($LaDate,0);
			  }
			  else
			  {
				  $LaDate='';
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
			  //Définition du QRCode avec md5(IDApi-IDRucher-NomRuche)
			  $QRCode='';
			  $QRCode=$_SESSION['ID_API'].'-'.$Id_Rucher.'-'.$LeNom;
			  $QRCode=md5($QRCode);
			  $Matable=array(':NOM'=>$LeNom,':NUM'=>$LeNum,':NbreC'=>$LeNbreC,':TypeR'=>$LeTypeR,':TypeH'=>$LeTypeH,':NbreH'=>$LeNbreH,':Etat'=>$Etat,':ID_R'=>$Id_Rucher,':Dat'=>$LaDate,':Obs'=>$LObs,':QRCode'=>$QRCode);
              $SQLS="CALL P_Add_Ruche(:NOM,:NUM,:NbreC,:TypeR,:TypeH,:NbreH,:Etat,:ID_R,:Dat,:Obs,:QRCode)";
/* Pour debug
echo "<pre>Session :";
print_r($_SESSION);
echo "</pre>";
echo "<pre>POST :";
print_r($_POST);
echo "</pre>";
echo "<pre>Table :";
print_r($Matable);
echo "</pre>";
*/
//echo "<p>$SQLS</p>";			 
			 $query=$DBConn->prepare($SQLS);
			 //On ajoute à la base
	         $query->execute($Matable); 
			  //On vérifie si la ruche à été créée :
			  $SQLS="SELECT count(*) AS Nombre from vue_ruche_api WHERE NUM_RUCHE='$LeNum' AND Nom_Ruche='$LeNom' AND ID_Apiculteur=$ID_Api";
			//On vérifie si la ruche existe déjà pour l'apiculteur
			  foreach($DBConn->query($SQLS) as $row)
			  {
				  $Compte=$row['Nombre'];  
			  }
			  if ($Compte>0)
			  {
				//La ruche à bien été créee  
			  	  $Page=$CheminTpl.'ruche_ajoutee.tpl';
			  } 
     	      else
			  {
					//Erreur dans la création du rucher
				 $Page=$CheminTpl.'ruche_erreur.tpl';			
			  }
			} //Fin else ruche existe pas
	   }//Fin on a poster un truc
	    else  //on a pas poster donc on affiche la page
	    {
		  //Récupération des infos de la BDD
		  /*
		   -0 : Nom du rucher
		   -1 : Type de hausse
		   -2 : Type de ruche
		   -3 : Etat de la ruche
		  */
		  $SQLS="SELECT Nom_Rucher FROM rucher WHERE id_Rucher=$Id_Rucher";
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $NomRucher=$row['Nom_Rucher'];
		  }
		  $template->assign('NOM_Rucher',$NomRucher);
		  //Récupération du type de hausse
		  $SQLS="SELECT id_hausses,type_cadre FROM hausses ORDER BY type_cadre ASC";
		  $i=0;
		  $TableHausses=array();
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $TableHausses[$i]['ID_H']=$row['id_hausses'];
			  $TableHausses[$i]['Type_H']=$row['type_cadre'];
			  $i++;
		  }
		  //Parse les éléments
		  $template->assign('liste_hausses',$TableHausses);
		  //Récupération type de ruche
		  $SQLS="SELECT ID_TYPERUCHE, NOM_TYPE_RUCHE FROM type_ruche ORDER BY NOM_TYPE_RUCHE";
		  $i=0;
		  $TableType=array();
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $TableType[$i]['ID_T']=$row['ID_TYPERUCHE'];
			  $TableType[$i]['Nom_T']=$row['NOM_TYPE_RUCHE'];
			  $i++;
		  }
		  //Parse les éléments
		  $template->assign('liste_types',$TableType);
		  //Récupère la liste des états
		  $SQLS="SELECT ID_ETAT,NOM_ETAT FROM etat_ruche ORDER BY NOM_ETAT";
		  $i=0;
		  $TableEtat=array();
		  foreach($DBConn->query($SQLS) as $row)
		  {
			  $TableEtat[$i]['ID_E']=$row['ID_ETAT'];
			  $TableEtat[$i]['Nom_E']=$row['NOM_ETAT'];
			  $i++;
		  }
		  //Parse les éléments
		  $template->assign('liste_etats',$TableEtat);
		  //Parse de la page
		  $Page=$CheminTpl.'ajout_ruche.tpl';
	    }
	  }//Fin récup numéro de rucher
	  else
	  {
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