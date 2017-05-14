<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	voir_essaim.php									 *
 * Date création :													 *
 * Date Modification :	08/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Affiche les infos de l'essaim selectionné						 *
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
       if (isset($_POST['Id_Essaim']))
	   {
		   $TemplateUser=$_SESSION['Template_User'];
		   $template->assign('TemplateUser',$TemplateUser);
		   $Id_Ruche=$_SESSION['ID_Ruche'];
		   $ID_Api=$_SESSION['ID_API'];
		   $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		   $Id_Essaim=(int)$_POST['Id_Essaim'];
		   if ($Id_Essaim==0)
		   {
			   //Pour la suite, on signale qu'on a aucun essaim de selectionné
			   $_SESSION['ID_Essaim']=0;
			   //On a pas d'essaim, il faut créé/affecter un essaim
			   			//selection du nom de la ruche en court
				$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$Id_Ruche";
				foreach($DBConn->query($SQLS) as $row)
				{
					$NomRucheAff=$row['Nom_Ruche'];
				}
				$template->assign('Nom_RucheSel',$NomRucheAff);
				//On selectionne les infos Ruches-Essaim appartenant à l'apiculteur
				$SQLS="SELECT ID_ESSAIM,NOM_ESSAIM, Nom_Ruche FROM vue_essaim_nomruche WHERE Id_Apiculteur=$ID_Api";
				$i=0;
				$MaTable=array();
				foreach($DBConn->query($SQLS) as $row)
				{
					$MaTable[$i]['ID_E']=$row['ID_ESSAIM'];
					$MaTable[$i]['NomE']=$row['NOM_ESSAIM'];
					$MaTable[$i]['NomR']=$row['Nom_Ruche'];
					$i++;
				}
				$template->assign('liste_essaims',$MaTable);
			     //On selectionne l'origine
				$SQLS="SELECT ID_ORIGINE, NOM_ORIGINE FROM origine_essaim ORDER BY NOM_ORIGINE";
				$i=0;
				$MaTable2=array();
				foreach($DBConn->query($SQLS) as $row)
				{
					$MaTable2[$i]['Id_O']=$row['ID_ORIGINE'];
					$MaTable2[$i]['Nom_O']=$row['NOM_ORIGINE'];
					$i++;
				}
				$template->assign('liste_origines',$MaTable2);
			   //En fin, on parse la page
			    $Page=$CheminTpl.'ajout_essaim.tpl';
		   }
		   else  //On a un essaim, on le montre
		   {
			   $_SESSION['ID_Essaim']=$Id_Essaim;
			   //Récupération du nom de la ruche
			   $SQLS="SELECT Nom_Ruche From ruche WHERE Id_Ruche=$Id_Ruche";
			   foreach($DBConn->query($SQLS) as $row)
	           {
					$Nom_Ruche=$row['Nom_Ruche'];
			   } 		
			   $template->assign('NomRuche',$Nom_Ruche);
			   //Récupération des infos de l'essaim et mise en forme des champs
			   $SQLS="SELECT E.ESPECE, E.DATE_CREATION,E.LIEU_CAPTURE,E.AGE_REINE,E.ORIGINE_REINE,E.NOM_ESSAIM,O.NOM_ORIGINE FROM Essaim E INNER JOIN origine_essaim O ON E.ID_Origine=O.ID_ORIGINE WHERE E.ID_ESSAIM=$Id_Essaim";
		       foreach($DBConn->query($SQLS) as $row)
	           {
					$Esp=$row['ESPECE'];
					$DateMR=$row['DATE_CREATION'];
					$lieu=$row['LIEU_CAPTURE'];
					$AgeR=$row['AGE_REINE'];
					$OrigR=$row['ORIGINE_REINE'];
					$OrigE=$row['NOM_ORIGINE'];
					$NomEssaim=$row['NOM_ESSAIM'];
			   }
			   ////////////////////////
				if (isset($Esp))
				{
					$Esp=$Esp;
				}
				else
				{
					$Esp='-';
				}
				if (isset($DateMR))
				{
					$DateMR=convertDate($DateMR,1);
				}
				else
				{
					$DateMR='-';
				}
				if (isset($lieu))
				{
					$lieu=$lieu;
				}
				else
				{
					$lieu='-';
				}
				if (isset($AgeR))
				{
					$AgeR=$AgeR;
				}
				else
				{
					$AgeR='-';
				}
				if (isset($OrigR))
				{
					$OrigR=$OrigR;
				}
				else
				{
					$OrigR='-';
				}
				$template->assign('Espece',$Esp);
				$template->assign('DateMR',$DateMR);
				$template->assign('Lieu',$lieu);
				$template->assign('AgeR',$AgeR);
				$template->assign('OrigR',$OrigR);
				$template->assign('OrigE',$OrigE);	
				$template->assign('NomEssaim',$NomEssaim);
			   /////////////////////
			   $Page=$CheminTpl.'voir_essaim.tpl';
		   }  //Fin else on a un essaim
		   $template->display($Page);
	   }//Fin if isset POST
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