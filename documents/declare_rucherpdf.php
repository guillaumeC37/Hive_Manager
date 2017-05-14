<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_recolte.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère le pdf de déclaration rucher								 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  require("../include/smarty.class.php");
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/editielpdf.inc.php";
  $template=new Smarty(); 
//On verifie si on est dans la session
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];
  }
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
	$ID_Rucher=$_SESSION['ID_Rucher'];
	$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	//Récupère les infos de l'apiculteur
	$SQLS="SELECT Nom_Api,Prenom_Api,Ville,Num_Rue,nom_Rue,Code_Postal,SIRET,Code_API,Nom_Type,Nom_Rucher,Localisation,Num_Rucher FROM vue_rucher_declaration WHERE id_Rucher=$ID_Rucher";
	foreach($DBConn->query($SQLS) as $row)
	{
		$NomApi=$row['Nom_Api'];
		$PrenomApi=$row['Prenom_Api'];
		if (isset($row['SIRET']))
		{
			$SIRET=$row['SIRET'];
		}
		else
			$SIRET='';
		//Formatage de l'adresse
		$Adresse=$row['Num_Rue'].' '.$row['Nom_Type'].' '.$row['nom_Rue'];
		$Adresse2=$row['Code_Postal'].' '.$row['Ville'];	
		$NAPI=$row['Code_API'];
		$NomRucher=$row['Nom_Rucher'];
		$Localisation=$row['Localisation'];
		$NumRucher=$row['Num_Rucher'];
	}
	$SQLS="SELECT count(*) AS Compte FROM ruche WHERE id_Rucher=$ID_Rucher";
	foreach($DBConn->query($SQLS) as $row)
	{
		$Compte=$row['Compte'];
	}
	$NbreRuche=$Compte;
//Creation du PDF
	$pdf= new EditielPDF();
	$pdf->setAuthor('Editiel98');
	$pdf->setCreator('Gestion Rucher');
	$pdf->SetTitle( html_entity_decode('Assistance déclaration du rucher'));
	$pdf->SetTitreDoc('Déclaration de rucher');
	$pdf->addPage();
	$pdf->SetFont('Arial','',10);
	$pdf->SetTextColor(255,0,0);
	$pdf->MultiCell(0,5,"Attention ce document n'est pas un document officiel. Pour effectuer votre déclaration il faut utiliser le CERFA 13995 trouvable à l'adresse ci dessous :");
	$pdf->SetTextColor(0,0,0);
	$pdf->ln(5);
	$pdf->cell(0,0,"https://www.formulaires.modernisation.gouv.fr/gf/cerfa_13995.do",0,1,'L',false,'https://www.formulaires.modernisation.gouv.fr/gf/cerfa_13995.do');	
	$pdf->SetInfo_Api($NomApi,$PrenomApi,$Adresse,$Adresse2,$NAPI,$SIRET);
	$pdf->ln(25);
	$pdf->AfficheEntete("Informations sur l'apiculteur");
	$pdf->ln(10);
	$pdf->Affiche_Api();
	$pdf->SetRucher($NomRucher,$NumRucher,$Localisation,$NbreRuche);
	$pdf->ln(15);
	$pdf->AfficheEntete("Informations sur le rucher");
	$pdf->ln(10);
	$pdf->Affiche_Rucher();
	$pdf->Output();
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page
	  $Page='../templates/erreur.tpl';
	  $template->display($Page);
  }
?>  