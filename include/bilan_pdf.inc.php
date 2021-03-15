<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	bilanpdf.inc.php								 *
 * Date création : 03/03/2017										 *
 * Date Modification : 10/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Fonction pour générer le pdf 									 *
 *	de bilan de la ruche											 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
include "fpdf.php";
class EditielPDF extends FPDF
{
	function Cell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
	{
        parent::Cell($w,$h, utf8_decode($txt), $border,$ln,$align,$fill,$link);
    }
	function Header()
	{
		//Fonction de création du header
		//Taille de la police pour l'affichage du titre
		$this->SetFont('Arial','B',15);  //Arial, Bold, 15
		$LeTitre=$this->TitreDoc;
		//Calcul de la taille du titre
		$TailleTitre=$this->GetStringWidth($LeTitre)+6; //6 pour la marge
		//On centre la cellule titre
		$this->setX((297-$TailleTitre)/2); //297 parce que A4
		//Cadre entourage=1
		$this->SetLineWidth(1);
		$this->Cell($TailleTitre,9,$LeTitre,1,1,'C',false); //Abscisse, hauteur, Texte, border, ln (retour à la ligne), align, remplir
		$this->ln(10); //saute 1 cm après le titre
	}
	function SetTitreDoc($TitreDocument)
	{
		$this->TitreDoc=$TitreDocument;
	}
	function Footer()
	{
	    // Positionnement à 1,5 cm du bas
		$this->SetY(-15);
    // Arial italique 8
		$this->SetFont('Arial','I',8);
    // Couleur du texte en gris
		$this->SetTextColor(128);
		$AJD=date('d/m/Y');
    // Numéro de page
		$this->Cell(0,10,"Document produit le $AJD");
		$this->ln(7);
		$this->Cell(0,10,'(c) Editiel98    Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	function Subtitle($date1,$date2)
	{
		//Affiche le sous titre avec la période de mesure
		$this->SetFont('Arial','B',10);  //Arial, Bold, 15
		$tailleSubTitle=$this->GetStringWidth("Releve de la ruche entre le $date1  et le $date2");
		$this->setX((297-$tailleSubTitle)/2);
		$this->Cell(0,0,"Relevé de la ruche entre le $date1  et le $date2");
		$this->ln(10);
	}
	function SetInfoRuche($Infos)
	{
		//affiche les infos de la ruche
		/*
		$TabInfo['DateMES']=$row['Date_MES'];*
				$TabInfo['NbreCadre']=$row['NBRE_CADRE'];*
				$TabInfo['NbreHausse']=$row['NBRE_HAUSSE'];*
				$TabInfo['NumRuche']=$row['NUM_RUCHE'];*
				$TabInfo['NomRuche']=$row['Nom_Ruche'];*
				$TabInfo['Obs']=$row['OBSERV'];
				$TabInfo['NomEtat']=$row['NOM_ETAT'];*
				$TabInfo['NomRucher']=$row['Nom_Rucher'];*
				$TabInfo['TypeRuche']=$row['NOM_TYPE_RUCHE'];*
		*/
		$Old_X=$this->GetX()+30;
		$Old_Y=$this->GetY();
		$Largeur=180;
		$Hauteur=90;
		$MargeTab=5;
		$this->BasRectangle=$Old_Y+$Hauteur+$MargeTab;
		$this->Rect($Old_X,$Old_Y,$Largeur,$Hauteur);
		$this->SetY($Old_Y+$MargeTab);
		//Centrage des infos
		$LargeurInfo=$this->GetStringWidth("Informations sur la ruche");
		$XCell=(($Old_X+$Largeur)-$LargeurInfo)/2;
		$this->SetX($XCell);
		$this->SetFont('Arial','BU',10);
		$this->Cell(0,0,"Informations sur la ruche");
		$this->SetFont('Arial','',10);
		$this->ln(7);
		//On répète cette opération a chaque ligne
		$this->SetX($Old_X+$MargeTab);
		$Taille=$this->GetStringWidth("Rucher");
		$this->SetFont('Arial','U',10);
		$this->Cell($Taille,0,"Rucher");
		$this->SetFont('Arial','',10);
		$Val=$Infos['NomRucher'];
		$this->Cell(0,0," : $Val");
		$this->ln(7);
		//Fin d'une ligne
		$this->SetX($Old_X+$MargeTab);
		$Taille=$this->GetStringWidth("Nom de la ruche");
		$this->SetFont('Arial','U',10);
		$this->Cell($Taille,0,"Nom de la ruche");
		$this->SetFont('Arial','',10);
		$Val=' : '.$Infos['NomRuche'];
		$Taille=$this->GetStringWidth($Val);
		$this->Cell($Taille,0,$Val);
		$Marge=130;
		$this->SetX($Marge);
		//deuxième info de la ligne
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth("Numero de la ruche");
		$this->Cell($Taille,0,"Numéro de la ruche");
		$this->SetFont('Arial','',10);
		$Val=' : '.$Infos['NumRuche'];
		$this->Cell(0,0,$Val);
		$this->ln(7);
		//Fin de la deuxième ligne
		$this->SetX($Old_X+$MargeTab);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth("Date de debut d'exploitation");
		$this->Cell($Taille,0,"Date de début d'exploitation");
		$this->SetFont('Arial','',10);
		$Val=' : '.$Infos['DateMES'];
		$Taille=$this->GetStringWidth($Val);
		$this->Cell($Taille,0,$Val);
		//Deuxième info de la ligne
		$Marge=130;
		$this->SetX($Marge);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth("Type de ruche");
		$this->Cell($Taille,0,"Type de ruche");
		$this->SetFont('Arial','',10);
		$Val=' : '.$Infos['TypeRuche'];
		$this->Cell(0,0,$Val);
		$this->ln(7);
		//Fin troisième ligne
		$this->SetX($Old_X+$MargeTab);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth("Nombre de cadres");
		$this->Cell($Taille,0,"Nombre de cadres");
		$this->SetFont('Arial','',10);
		$Val=' : '.$Infos['NbreCadre'];
		$Taille=$this->GetStringWidth($Val);
		$this->Cell($Taille,0,$Val);
		//Deuxième info de la ligne
		$Marge=130;
		$this->SetX($Marge);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth("Nombre de hausses");
		$this->Cell($Taille,0,"Nombre de hausses");
		$this->SetFont('Arial','',10);
		$Val=' : '.$Infos['NbreHausse'];
		$this->Cell(0,0,$Val);
		$this->ln(7);
		//Fin quatrième ligne
		$this->SetX($Old_X+$MargeTab);
		$Taille=$this->GetStringWidth("Etat");
		$this->SetFont('Arial','U',10);
		$this->Cell($Taille,0,"Etat");
		$this->SetFont('Arial','',10);
		$Val=$Infos['NomEtat'];
		$this->Cell(0,0," : $Val");
		$this->ln(7);
		//Observations
		$this->SetX($Old_X+$MargeTab);
		$this->SetFont('Arial','U',10);
		$this->Cell(0,0,"Observations");
		$this->SetFont('Arial','',8);
		$this->ln(5);
		$Val=$Infos['Obs'];
		$this->SetX($Old_X+$MargeTab+5);
		$this->MultiCell(0,3,$Val);
		$this->ln(10);
		
	}
	function Setgraphe($Image,$titre)
	{
		//Affiche le titre
		$this->ln(15);
		$this->SetFont('Arial','B',15);
		$this->Cell(0,0,$titre);
		$this->ln(20);
		$Largeur=200;
		$X_Graph=(297-$Largeur)/2;
		$Y_Graph=$this->getY();
		//affiche l'image
		$this->image($Image,$X_Graph);
	}
	function SetRecoltes($Totale,$ParType)
	{
		//Affiche les infos de récolte
		$this->SetY($this->BasRectangle);
		$this->SetFont('Arial','U',15);
		$this->Cell(0,0,"Informations sur les récoltes");
		$this->ln(7);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth("Poids total recolte");
		$this->SetX(15);
		$this->Cell($Taille,0,"Poids total recolté");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0," : $Totale kg");
		$this->SetFont('Arial','U',15);
		$this->ln(10);
		$this->Cell(0,0,"Informations sur les récoltes par type de miel");
		$this->ln(7);
		//Nombre de ligne dans le tableau, ce qui définira le nombre de ligne/colonne a afficher
		$NbreLigne=count($ParType);
		//On peut afficher 6 types de miel par ligne
		for($i=0;$i<$NbreLigne;$i++)
		{
			if(($i%6)==0)
				$this->ln(7);
			$this->SetFont('Arial','BU',10);
			$LeType=$ParType[$i]['TypeMiel'];
			$LePoids=' : '.$ParType[$i]['Poids_Miel'].'kg   ';
			$Taille=$this->GetStringWidth($LeType);
			$this->Cell($Taille,0,$LeType);
			$Taille=$this->GetStringWidth($LePoids);
			$this->SetFont('Arial','',10);
			$this->Cell($Taille,0,$LePoids);
			//$Marge=$this->GetX()+2;
			//$this->Cell($Marge,0,'');
		}
	}
	function InfosDataLogger($DateDebut,$DateFin,$Dataloggers)
	{
		$Texte="Le datalogger est un système électronique programmable d'enregistrement de données concernant la ruche. Ce système permet un suivi de l'évolution de la ruche
		en mesurant le poids, les températures et l'hygrométrie de la ruche et de son environnement.
		Ils sont identifiés par un numéro unique et associés à la ruche via un fichier de configuration créé par le logiciel.";
		$this->SetFont('Arial','BU',15);
		$Taille=$this->GetStringWidth('Informations du datalogger');
		$this->SetX((297-$Taille)/2);
		$this->Cell(0,0,'Informations du datalogger');
		$this->ln(15);
		$this->SetFont('Arial','',15);
		$this->multiCell(0,7,$Texte);
		$this->ln(10);
		if($DateDebut=='')
		{
			$this->Cell(0,0,"Il n'y a pas d'enregistrement pour cette ruche");
			$this->ln(7);
		}
		else
		{
			$this->multiCell(0,7,"Les enregistreurs utilisés pour les relevés de cette ruches sur la période du $DateDebut au $DateFin ont les numéros de série suivants :");
			$this->ln(10);
			foreach($Dataloggers as $value)
			{
				$this->Cell(0,0,"-Datalogger N° : $value");
				$this->ln(7);
			}
		}
	}
	function SetMoyennes($Poids, $TempExt,$TempInt,$HygroExt,$HygroInt)
	{
		$this->SetFont('Arial','BU',15);
		$this->ln(30);
		$this->Cell(0,0,"Valeurs moyennes des relevés du datalogger");
		$this->ln(25);
	//Debut ligne	
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Poids moyen');
		$this->Cell($Taille,0,'Poids moyen');
		$this->SetFont('Arial','',10);
		if($Poids=='')
			$this->Cell(0,0,' : aucun relevé');
		else
			$this->Cell(0,0," : $Poids Kg");
		$this->ln(15);
	//Fin ligne
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Hygrometrie interieure');
		$this->Cell($Taille,0,'Hygrométrie intérieure');
		$this->SetFont('Arial','',10);
		if($HygroInt=='')
			$this->Cell(0,0,' : aucun relevé');
		else
			$this->Cell(0,0," : $HygroInt%");
		$this->ln(15);
		//
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Hygrometrie exterieure');
		$this->Cell($Taille,0,'Hygrométrie extérieure');
		$this->SetFont('Arial','',10);
		if($HygroExt=='')
			$this->Cell(0,0,' : aucun relevé');
		else
			$this->Cell(0,0," : $HygroExt%");
		$this->ln(15);
		//
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Temperature interieure');
		$this->Cell($Taille,0,'Température intérieure');
		$this->SetFont('Arial','',10);
		if($TempInt=='')
			$this->Cell(0,0,' : aucun relevé');
		else
			$this->Cell(0,0,' : '.$TempInt.'°');
		$this->ln(15);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Temperature exterieure');
		$this->Cell($Taille,0,'Température extérieure');
		$this->SetFont('Arial','',10);
		if($TempExt=='')
			$this->Cell(0,0,' : aucun relevé');
		else
			$this->Cell(0,0,' : '.$TempExt.'°');
		$this->ln(15);
	}
}	
?>