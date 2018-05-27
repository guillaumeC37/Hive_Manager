<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	rucherpdf.inc.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère le pdf de stat du rucher									 *
 *																	 *
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
		$this->setX((210-$TailleTitre)/2); //210 parce que A4
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
    // Numéro de page
		$this->Cell(0,10,'(c) Editiel98    Page '.$this->PageNo(),0,0,'C');
	}
	//Affiche les informations du rucher et de l'apiculteur
	function Affiche_Info_Rucher($Nom_Api, $Prenom_Api, $Nom_Rucher, $Num_Rucher, $Localisation, $Actif, $Observations)
	{
		$this->SetFont('Arial','',10);
		$this->SetTextColor(0);
		$Ligne="Apiculteur : $Nom_Api $Prenom_Api";
		$this->cell(0,0,$Ligne,0,0);
		$this->ln(15);
		$this->cell(5,0);
		$this->SetFont('Arial','BU',15);
		$this->cell(0,0,'Informations sur le rucher',0,0);
		$this->ln(10);
		$this->SetFont('Arial','U',10);
		$TailleTitre=$this->GetStringWidth('Nom du rucher');
		$this->cell($TailleTitre,0,'Nom du rucher',0,0);
		$this->SetFont('Arial','',10);
		$this->cell(0,0,' : '.$Nom_Rucher,0,0);
		$this->ln(7);
		$Taille=$this->GetStringWidth('Numero du rucher');
		$this->SetFont('Arial','U',10);
		$this->cell($Taille,0,'Numéro du rucher',0,0);
		$this->SetFont('Arial','',10);
		$this->cell(0,0," : $Num_Rucher",0,0);
		$this->ln(7);
		$Taille=$this->GetStringWidth('Localisation');
		$this->SetFont('Arial','U',10);
		$this->cell($Taille,0,'Localisation',0,0);
		$this->SetFont('Arial','',10);
		$this->cell(0,0," : $Localisation",0,0);
		if ($Actif==0)
			$LeActif='Mort';
		else
			$LeActif='Actif';
		$this->ln(7);
		$Taille=$this->GetStringWidth('Etat');
		$this->SetFont('Arial','U',10);
		$this->cell($Taille,0,'Etat',0,0);
		$this->SetFont('Arial','',10);
		$this->cell(0,0," : $LeActif",0,0);
		$this->ln(7);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Observations');
		$this->cell($Taille,0,'Observations',0,0);
		$this->SetFont('Arial','',10);
		$this->cell(0,0," : ",0,0);
		$this->ln(7);
		$this->SetX(20);
		$this->MultiCell(0,5,$Observations);
		$this->ln(10);		
	}
	function SetNombreRuche($LeNombre)
	{
		$this->SetFont('Arial','BU',15);
		$this->cell(5,0);
		$this->cell(0,0,'Informations sur les ruches');
		$this->ln(10);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Nombre de ruches');
		$this->cell($Taille,0,'Nombre de ruches');
		$this->SetFont('Arial','',10);
		$this->cell(0,0," : $LeNombre ruches");
		$this->ln(10);
		$this->cell(0,0,'Dont : ');
		$this->ln(7);
	}
	function SetRucheEtat($Nombre, $Etat)
	{
		$this->SetX(15);
		$this->SetFont('Arial','',10);
		$this->cell(0,0,"$Nombre ruches(s) $Etat");
		$this->ln(7);
	}
	function SetTotalRecolte($Poids)
	{
		//On re saute une 1 ligne
		$this->ln(7);
		$this->SetFont('Arial','BU',15);
		$this->cell(5,0);
		$this->cell(0,0,'Informations sur les récoltes');
		$this->ln(10);
		$this->SetFont('Arial','',10);
		$this->cell(0,0,"Récolte totale : $Poids kg");
		$this->ln(10);
		$this->SetFont('Arial','U',10);
		$Taille=$this->GetStringWidth('Recolte par type de miel');
		$this->cell($Taille,0,'Récolte par type de miel');
		$this->SetFont('Arial','',10);
		$this->cell(0,0,' : ');
		$this->ln(7);
	}
	function SetRecolteType($LeType,$LePoids)
	{
		$this->SetX(15);
		$this->SetFont('Arial','',10);
		$this->cell(0,0, "$LeType : $LePoids kg");
		$this->ln(7);
	}
	//Ajout du 27/05/2018
	function Setgraphe($Image,$titre)
	{
		//Affiche le titre
		$this->ln(15);
		$this->SetFont('Arial','B',15);
		$this->Cell(0,0,$titre);
		$this->ln(20);
		$Largeur=200;
		$X_Graph=2;
		$Y_Graph=$this->getY();
		//affiche l'image
		$this->image($Image,$X_Graph);
	}
}