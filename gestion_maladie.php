<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	gestion_maladie.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Depuis la page apiculteur, gère la liste des maladies			 *
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
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
	  //On parse la page
	  if(isset($_SESSION['ID_API']))
	  {
		$ID_Api=$_SESSION['ID_API'];
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		if (isset($_POST['Modif_Form']))
		{
			  //On ajoute une maladie
			if(isset($_POST['NomMaladie']))
			{
				$NomNouvelle=htmlspecialchars($_POST['NomMaladie'],ENT_NOQUOTES,'UTF-8');
				$SQLS="INSERT INTO maladie(Nom_Maladie,Id_Api) VALUES (:Nom_M,:ID_Api)";
				$TableTemp=array(':Nom_M'=>$NomNouvelle,':ID_Api'=>$ID_Api);
				$query=$DBConn->prepare($SQLS);
				$query->execute($TableTemp);				
			}
			  
		}
		//On affiche		
		$SQLS="select Nom_Maladie FROM maladie WHERE Id_Api=$ID_Api ORDER BY Nom_Maladie";
		$query=$DBConn->prepare($SQLS);
		$query->execute();
		$ListeMaladie=array();
		$i=0;
		while($data=$query->fetch())
		{
			$ListeMaladie[$i]['Nom_Maladie']=$data['Nom_Maladie'];	
			$i++;
		}
		$template->Assign('liste_maladie',$ListeMaladie);
		$template->display($CheminTpl.'ges_maladie.tpl');
	  }
	  else
	  {
		  //No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
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