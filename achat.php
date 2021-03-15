<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	achat.php										 *
 * Date création :	04/03/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version : 0.2A													 *
 * Objet et notes :	Gère les informations d'achats					 *
 *																	 *
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
		if (isset($_SESSION['ID_API']))
		{
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
			$TemplateUser=$_SESSION['Template_User'];
			$template->assign('TemplateUser',$TemplateUser);
			$ID_Api=$_SESSION['ID_API'];
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			if(isset($_POST['Nouvel_Achat']))
			{
				//On ajoute l'achat
				$Erreur=true;
				if(isset($_POST['Magasin']))
				{
					$Erreur=false;
					//On traite la donnée
					$LeMagasin=htmlspecialchars($_POST['Magasin'],ENT_NOQUOTES,'UTF-8');
				}
				if(isset($_POST['Montant']))
				{
					$Erreur=false;
					$LeMontant=$_POST['Montant'];
					if((filter_var($LeMontant, FILTER_VALIDATE_FLOAT))||(filter_var($LeMontant, FILTER_VALIDATE_INT)))
					{
						
					}
					else
					{
						echo "<p>Montant incorrect</p>";
					}
					//On traite la donnée
				}
				if(isset($_POST['DateAchat']))
				{
					$Erreur=false;
					$LaDate=htmlspecialchars($_POST['DateAchat'],ENT_NOQUOTES,'UTF-8');
					$LaDate=ConvertDate($LaDate,0);
					//On traite la donnée
				}
				if(isset($_POST['Desc']))
				{
					$Erreur=false;
					$Desc=htmlspecialchars($_POST['Desc'],ENT_NOQUOTES,'UTF-8');
					$Desc=nl2br($Desc);
					//On traite la donnée
				}
				if(!$Erreur)
				{
					//On enregistre l'achat
					$TabNewAchat=array(':DateA'=>$LaDate,':Montant'=>$LeMontant,':Magasin'=>$LeMagasin,':Desc'=>$Desc,':Api'=>$ID_Api);
					$SQLS="CALL P_Add_Achat(:DateA,:Montant,:Magasin,:Desc,:Api)";
					$query=$DBConn->prepare($SQLS);
					$query->execute($TabNewAchat);
				}
			}
			//On affiche les achats
			$SQLS="SELECT MAGASIN, MONTANT, DATE_ACHAT, DESCRIPTION FROM achat WHERE ID_Apiculteur=$ID_Api ORDER BY DATE_ACHAT";
			$TabAchat=array();
			$i=0;
			foreach($DBConn->query($SQLS) as $row)
			{
				$TabAchat[$i]['Montant']=$row['MONTANT'];
				$TabAchat[$i]['Magasin']=$row['MAGASIN'];
				$TabAchat[$i]['DateAchat']=$row['DATE_ACHAT'];
				$TabAchat[$i]['Description']=$row['DESCRIPTION'];
				$TabAchat[$i]['index']=$i;
				$i++;
			}
			$template->assign('Liste_Achats',$TabAchat);
			$template->display($CheminTpl.'achat.tpl');
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