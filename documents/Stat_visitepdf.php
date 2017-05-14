<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_visitepdf.php								 *
 * Date création :	25/02/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	0.2A												 *
 * Objet et notes :													 *
 *		Génère le rapport pdf des visites							 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/editielpdf.inc.php";
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
echo "</pre>";
*/
	  //On parse la page
	  if (isset ($_SESSION['Date_Debut']))
	  {
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$Id_Ruche=$_SESSION['ID_Ruche'];
		//
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$Id_Ruche";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomRuche=$row['Nom_Ruche'];  
		}
		//
		$DateDebut=convertDate($_SESSION['Date_Debut'],0);
		$DateFin=convertDate($_SESSION['Date_Fin'],0);
		$SQLS="SELECT Temperature,Hygro,Travaux,Nourrissage,Type_Nourrissage,Poids,Reine_Visible,Population,Comportement,Notes,Date_Visite,Presence_Maladie,Nom_Maladie,Climat FROM vue_visite WHERE Id_Ruche=$Id_Ruche  AND Date_Visite BETWEEN '$DateDebut' AND '$DateFin' ORDER BY Date_Visite ASC";
		$i=0;
			$TableVisite=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				//Dans la boucle, en ce qui concerne les cases à cocher il faut traiter autrement que comme cela
				$LaDate=convertDate($row['Date_Visite'],1);
				$TableVisite[$i]['Date_V']=$LaDate;
				$TableVisite[$i]['Numero']=$i;
				if($row['Comportement']=='')
				{
					$Comportement='Non renseigné';
				}
				else
					$Comportement=$row['Comportement'];
				$TableVisite[$i]['Comportement']=$Comportement;
				if($row['Population']=='')
				{
					$population='Non renseigné';
				}
				else
					$population=$row['Population'];
				$TableVisite[$i]['Population']=$population;
				if($row['Presence_Maladie']==0)
				{
					$Maladie='Aucune';
					$NomMaladie='';
				}
				else
				{
					$Maladie='Oui :';  //A changer par autre chose de plus "visuel"
					$NomMaladie=$row['Nom_Maladie'];
				}
				$TableVisite[$i]['Maladie']=$Maladie;
				$TableVisite[$i]['NomMaladie']=$NomMaladie;
				if($row['Reine_Visible']==0)
				{
					$Visible='Non';
				}
				else
				{
					$Visible='Oui';
				}
				$TableVisite[$i]['ReineVisible']=$Visible;
				if($row['Poids']==0)
				{
					$poids='Non mesuré;';
				}
				else
				{
					$poids=$row['Poids'].' kg';
				}
				$TableVisite[$i]['Poids']=$poids;
				if($row['Temperature']==-100)
				{
					$temp='Non mesurée';
				}
				else
					$temp=$row['Temperature'].'°C';
				$TableVisite[$i]['Temperature']=$temp;
				$TableVisite[$i]['Climat']=$row['Climat'];
				if ($row['Hygro']==0)
				{
					$Hygro='Non mesurée';
				}
				else
					$Hygro=$row['Hygro'].'%';
				$TableVisite[$i]['Hygro']=$Hygro;
				if ($row['Nourrissage']==0)
				{
					$Nourrissage='Non effectué';
				}
				else
					$Nourrissage='Oui :';
				$TableVisite[$i]['Nourrissage']=$Nourrissage;
				$TableVisite[$i]['Type_Nourrissage']=$row['Type_Nourrissage'];
				if($row['Travaux']==0)
				{
					$Travaux='non';
				}
				else
					$Travaux='oui';
				$TableVisite[$i]['Travaux']=$Travaux;
				if($row['Notes']=='')
				{
					$Notes='Aucunes';
				}
				else
					$Notes=$row['Notes'];
				$Notes=str_replace("\r\n", "",$Notes); 
				$TableVisite[$i]['Notes']=str_replace("<br />", "\n",$Notes);  
				//Convertir les Br en \n ??
				//str_replace("<br />", "\n", $ta_chaine_de_caractere);
				$i++;
			}
		/*	echo "<pre>";
			print_r($TableVisite);
			echo "</pre>";*/
			//On génère le pdf
			$pdf= new EditielPDF();
			$pdf->setAuthor('Editiel98');
			$pdf->setCreator('Gestion Rucher');
			$pdf->SetTitle( html_entity_decode("Historique des visites de la ruche $NomRuche"));
			$pdf->SetTitreDoc("Historique des visites de la ruche $NomRuche");
			$pdf->addPage();
			$pdf->SetFont('Arial','',10);
			$pdf->SetTextColor(0,0,0);
			$pdf->Cell_Center("Du $DateDebut au $DateFin");
			$pdf->ln(10);  //saut de 10mm
			$i=0;
			$Max=count($TableVisite);
			foreach($TableVisite as $LaTable)
			{
			  $pdf->Affiche_Visite($LaTable);
			  $i++;
			  if ($i<$Max)
			  {
				$pdf->addPage();
			  }
			}
			//
			//$pdf->Affiche_Rucher();
			$pdf->Output();
	  }  //fin On a une date de début
	  else
	  {
		  //No man's land
		$Page='../templates/erreur.tpl';
		$template->display($Page);
	  }
  }//Fin de on est dans la session
  else
  {
	$template=new Smarty(); 
	require("../include/smarty.class.php");
	//On est pas dans la session
	//On parse la page
	$Page='../templates/erreur.tpl';
	$template->display($Page);
  }
?>  