<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	gest_apparence.php								 *
 * Date création :	03/03/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version : 0.2A													 *
 * Objet et notes :	Permet la gestion des styles d'affichage		 *
 *	pour l'apiculteur												 *
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
	if(isset($_SESSION['ID_API']))
	{	
		$ID_Api=$_SESSION['ID_API'];
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		if (isset($_POST['changeFond']))
		{
			if(isset($_POST['changeFond']))
			{
				//On change le fond
				$NouveauTemplate=htmlspecialchars($_POST['template'],ENT_NOQUOTES,'UTF-8');
				$SQLS="SELECT count(Nom_template) as Nombre FROM templates WHERE Nom_template='$NouveauTemplate'";
				$Compte=0;
				foreach($DBConn->query($SQLS) as $row)
				{
					$Compte=$row['Nombre'];  
				}
				if($Compte==1)
				{
					$SQLS="UPDATE param SET Value_Param='$NouveauTemplate' WHERE Nom_Param='Template' AND ID_Apiculteur=$ID_Api";
					$OK=$DBConn->exec($SQLS);
					if($OK==1)
					{
						//On change dans la base en vérfiant si OK
						$_SESSION['Template_User']=$NouveauTemplate;
					}
				}
			}
		}
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		//Selection de l'apparence courante pour l'apiculteur
		$SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Template' AND ID_Apiculteur=$ID_Api";
		foreach($DBConn->query($SQLS) as $row)
		{
			$Affiche=$row['Value_Param'];  
		}
		$template->assign('Nom_app',$Affiche);
		$SQLS="SELECT Nom_template FROM templates ORDER BY Nom_template";
		$i=0;
		$TabTemplates=array();
		foreach($DBConn->query($SQLS) as $row)
		{		
			$TabTemplates[$i]['Nom_App']=$row['Nom_template']; 
			$TabTemplates[$i]['Id_App']=$row['Nom_template'];
			$i++;
		}
		$template->assign('liste_app',$TabTemplates);
		$Page=$CheminTpl.'apparence.tpl';
		$template->display($Page);
	}
	else
	{
		 //No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	}
	  //On parse la page
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