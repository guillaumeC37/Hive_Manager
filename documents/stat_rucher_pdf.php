<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_rucher_pdf.php								 *
 * Date création :	25/02/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	0.2A												 *
 * Objet et notes :													 *
 *		Génère le rapport pdf des statistiques du rucher			 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 session_start();
  require("../include/smarty.class.php");
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/rucherpdf.inc.php";
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
	if(isset($_SESSION['ID_Rucher']))
	{
		$ID_Rucher=$_SESSION['ID_Rucher'];
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		//Récupération des infos du rucher
		$SQLS="SELECT A.Nom_Api, A.Prenom_Api,R.Nom_Rucher,R.Num_Rucher,R.Localisation,R.IsActif,R.Observations FROM rucher R INNER JOIN apiculteur A ON R.ID_Apiculteur=A.ID_Apiculteur WHERE R.id_Rucher=$ID_Rucher"; 
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomApi=$row['Nom_Api']; 
			$PrenomApi=$row['Prenom_Api'];			
			$NomRucher=$row['Nom_Rucher'];
			$NumRucher=$row['Num_Rucher']; 
			$Loc=$row['Localisation'];			
			$Actif=$row['IsActif'];
			$Obs=$row['Observations'];
		}
		//génération du pdf
		//Creation du PDF
		//En tete
		$pdf= new EditielPDF();
		$pdf->setAuthor('Editiel98');
		$pdf->setCreator('Gestion Rucher');
		$pdf->SetTitle( html_entity_decode('Statistique du rucher'));
		$pdf->SetTitreDoc('Statistique du rucher');
		$pdf->addPage();
		//Mise en page des infos du rucher
		$pdf->Affiche_Info_Rucher($NomApi, $PrenomApi, $NomRucher, $NumRucher, $Loc, $Actif, $Obs);
		//Selectionne le nombre de ruche total dans le rucher
		$SQLS="SELECT count(*) AS compte FROM ruche WHERE ID_Rucher=$ID_Rucher";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NbreRuche=$row['compte'];
		}
		//Mise en page des infos 
		$pdf->SetNombreRuche($NbreRuche);
		//Récupère le nombre de ruche en fonction de leur état
		$SQLS="SELECT count(R.ID_ETAT) as nombre,E.NOM_ETAT FROM etat_ruche E LEFT JOIN ruche R ON E.ID_ETAT=R.ID_ETAT WHERE ID_Rucher=$ID_Rucher GROUP BY E.ID_ETAT";
		$i=0;
		$TabEtat=array();
		foreach($DBConn->query($SQLS) as $row)
		{
			$pdf->SetRucheEtat($row['nombre'], $row['NOM_ETAT']);
		}
		//Récupère la quantité de récolte totale pour le rucher
		$SQLS="SELECT SUM(Re.Poids) as Poids FROM recolte Re INNER JOIN ruche ON Re.Id_Ruche=ruche.Id_Ruche WHERE ruche.id_rucher=$ID_Rucher";
		foreach($DBConn->query($SQLS) as $row)
		{
			  $poidstotal=$row['Poids'];
		}
		if ($poidstotal=='')
		{
			  $poidstotal=0;
		}  
		//Mise en page du poids total
		$pdf->SetTotalRecolte($poidstotal);
		//Récolte par type de miel
		$SQLS="SELECT SUM(Re.Poids) as Poids, T.Nom_Type_Miel FROM recolte Re INNER JOIN type_miel T ON T.Id_Type_Miel=Re.Id_Type_Miel INNER JOIN ruche Ru ON Re.Id_Ruche=Ru.Id_Ruche WHERE Ru.Id_rucher=$ID_Rucher GROUP BY Re.Id_Type_Miel";
		$i=0;
		$TabRecolte=array();
		foreach($DBConn->query($SQLS) as $row)
		{
			  $pdf->SetRecolteType($row['Nom_Type_Miel'],$row['Poids']);
		}
		//Affichage du pdf
		$pdf->Output();
	} //
	else
	{
		//No man's land
	}
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
	  //On parse la page
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page
	  $Page='../templates/erreur.tpl';
	  $template->display($Page);
	      //traitement quoi qu'il en soit
  $Pied=new Smarty(); 
  $DBConn2=connectbase($userdb,$passdb,$servdb,$nomdb);
  $SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Version'";
  foreach($DBConn2->query($SQLS) as $row)
  {
	$Version=$row['Value_Param'];  
  }
  $Pied->Assign('Version',$Version);
  $Pied->display('../templates/pied.tpl');
  }

?>  