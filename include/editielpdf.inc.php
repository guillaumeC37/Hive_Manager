<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	editielpdf.inc.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Regroupe les fonction pour générer le 							 *
 *	pdf de déclaration de rucher									 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
include "fpdf.php";
class EditielPDF extends FPDF
{
	protected $TitreDoc='';
	protected $Nom_Api='';
	protected $Prenom_Api='';
	protected $Adresse_Api='';
	protected $Adresse2_Api='';
	protected $NAPI='';
	protected $SIRET='';
	protected $Loc='';
	protected $NumRucher='';
	protected $NomRucher='';
	protected $Nbre_Ruche='';
	//protected
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
		$this->setX((210-$TailleTitre)/2); //210 parce que A4
		//Cadre entourage=1
		$this->SetLineWidth(1);
		$this->Cell($TailleTitre,9,$LeTitre,1,1,'C',false); //Abscisse, hauteur, Texte, border, ln (retour à la ligne), align, remplir
		$this->ln(10); //saute 1 cm après le titre
	}
	function Cell_Center($Texte)
	{
		//$this->SetFont('Arial','',10);
		$TailleText=$this->GetStringWidth($Texte)+6; //6 pour la marge
		$this->setX((210-$TailleText)/2);
		$this->Cell($TailleText,0,$Texte,0,0,'C',false);
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
    // Numéro de page
		$this->Cell(0,10,'(c) Editiel98    Page '.$this->PageNo(),0,0,'C');
	}
	function SetInfo_Api($Nom,$Prenom,$Adresse,$Adresse2,$NAPI,$SIRET)
	{
		$this->Nom_Api=$Nom;
		$this->Prenom_Api=$Prenom;
		$this->Adresse_Api=$Adresse;
		$this->Adresse2_Api=$Adresse2;
		$this->NAPI=$NAPI;
		$this->SIRET=$SIRET;
	}
	function Affiche_Api()
	{
		//Nom
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('Nom : ');
		$this->Cell($taille,0,'Nom : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->Nom_Api);
		$this->ln(6);
		//Prenom
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('Prenom : ');
		$this->Cell($taille,0,'Prénom : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->Prenom_Api,0,0,'L');
		$this->ln(6);
		//Adresse
		$this->SetFont('Arial','B',10);
		$this->Cell(0,0,'Adresse : ',0,0);
		$this->SetFont('Arial','',10);
		$this->ln(6);
		$this->Cell(0,0,$this->Adresse_Api);
		$this->ln(4);
		$this->Cell(0,0,$this->Adresse2_Api);
		$this->ln(6);
		//NAPI
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('NAPI : ');
		$this->Cell($taille,0,'NAPI : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->NAPI);
		$this->ln(6);
		//SIRET
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('SIRET : ');
		$this->Cell($taille,0,'SIRET : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->SIRET);
		$this->ln(6);
	}
	function AfficheEntete($Entete)
	{
		$this->SetFont('Arial','BU',15);  //Arial, Bold, 15
		$TailleTitre=$this->GetStringWidth($Entete)+6; //6 pour la marge
		$this->Cell($TailleTitre,0,$Entete,0,0,'R');
		$this->SetFont('Arial','',10);	
	}
	function SetRucher($NomRucher,$NumRucher,$Localisation,$NbreRuche)
	{
		$this->NomRucher=$NomRucher;
		$this->NumRucher=$NumRucher;
		$this->Loc=$Localisation;
		$this->Nbre_Ruche=$NbreRuche;
	}
	function Affiche_Rucher()
	{
		//Nom
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('Nom : ');
		$this->Cell($taille,0,'Nom : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->NomRucher);
		$this->ln(6);
		//Numéro 
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('Numero : ');
		$this->Cell($taille,0,'Numéro : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->NumRucher);
		$this->ln(6);
		//Localisation
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('Localisation : ');
		$this->Cell($taille,0,'Localisation : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->Loc);
		$this->ln(6);
		//Nombre de ruches
		$this->SetFont('Arial','B',10);
		$taille=$this->GetStringWidth('Nombre de ruches : ');
		$this->Cell($taille,0,'Nombre de ruches : ',0,0);
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,$this->Nbre_Ruche);
		$this->ln(6);
	}
	function Affiche_Visite($LaVisite)
	{
		//LaVisite est un tableau.
		/*
		[Date_V] => 01/02/2017
            [Numero] => 0
            [Comportement] => Cool
            [Population] => Faible
            [Maladie] => Oui :
            [NomMaladie] => Varoa
            [ReineVisible] => Oui
            [Poids] => 12 kg
            [Temperature] => 15°C
            [Climat] => beau temps
            [Hygro] => 10%
            [Nourrissage] => Non effectué
            [Type_Nourrissage] => 
            [Travaux] => non
            [Notes] => Aucunes
			*/
		//on remplace &deg; par °
		$this->SetFont('Arial','',10);
		$TailleDate=$this->GetStringWidth('Date de la visite : ');
		$this->Cell($TailleDate,0,'Date de la visite : ',0,0);	
		$this->Cell(0,0,$LaVisite['Date_V']);
		$this->ln(10);
		//Ligne Titre
		// Décalage de 1 cm à droite
		$this->Cell(10);
		$this->SetFont('Arial','U',10);
		$this->Cell(0,0,'Informations sur la ruche');
		$this->ln(7);
//Debut d'une ligne d'info
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Comportement de l'essaim");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Comportement de l'essaim");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Comportement']);
		$this->ln(7);
//Fin d'une ligne d'info
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Etat de la population");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Etat de la population");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Population']);
		$this->ln(7);	
		//Maladie
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Maladie");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Maladie");
		$this->SetFont('Arial','',10);
		$Taille=$this->GetStringWidth(' : '.$LaVisite['Maladie'].' ');
		$this->Cell($Taille,0,' : '.$LaVisite['Maladie'].' ');
		$this->Cell(0,0,$LaVisite['NomMaladie']);
		$this->ln(7);
		//Reine Visible
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Reine visible");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Reine visible");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['ReineVisible']);
		$this->ln(15);
				//Ligne Titre
		// Décalage de 1 cm à droite
		$this->Cell(10);
		$this->SetFont('Arial','U',10);
		$this->Cell(0,0,'Mesures effectuées');
		$this->ln(7);
		//Temperature
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Temperature");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Température");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Temperature']);
		$this->ln(7);
		//Climat
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Climat");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Climat");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Climat']);
		$this->ln(7);
		//Hygrométrie
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Hygrometrie");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Hygrométrie");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Hygro']);
		$this->ln(7);
		//Poids
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Poids");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Poids");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Poids']);
		$this->ln(15);
				//Ligne Titre
		// Décalage de 1 cm à droite
		$this->Cell(10);
		$this->SetFont('Arial','U',10);
		$this->Cell(0,0,'Actions effectuées');
		$this->ln(7);
		//Nourrissage
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Nourrissage");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Nourrissage");
		$this->SetFont('Arial','',10);
		$Taille=$this->GetStringWidth($LaVisite['Nourrissage']);
		$this->Cell($Taille,0,' : '.$LaVisite['Nourrissage']);
		$this->Cell(0,0,' '.$LaVisite['Type_Nourrissage']);
		$this->ln(7);
		//Travaux
		$this->SetFont('Arial','BU',10);
		$Largeur=$this->GetStringWidth("Travaux a prevoir");
		$this->Cell(15);
		$this->Cell($Largeur,0,"Travaux à prévoir");
		$this->SetFont('Arial','',10);
		$this->Cell(0,0,' : '.$LaVisite['Travaux']);
		$this->ln(15);
		// Décalage de 1 cm à droite
		$this->Cell(10);
		$this->SetFont('Arial','U',10);
		$this->Cell(0,0,'Notes');
		$this->ln(7);
		$this->SetFont('Arial','',10);
		$this->Cell(15);
		$this->MultiCell(0,4,$LaVisite['Notes']);
	}
}