<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	drawDatalog.php									 *
 * Date création :	07/03/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère les graphes pour le datalogger							 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
include('jpgraph/jpgraph_date.php');
require_once ('jpgraph/jpgraph_utils.inc.php');
function formdate($aVal)
{
	return date('d-m-y',$aVal);
}
function DrawGraph2Courbes($DateDebut,$DateFin,$TabResultat,$Width,$Height,$Titre,$theme,$Destination)
{
	$MinDate=explode('-',$DateDebut);
	$MinDate=mktime(0,0,0,$MinDate[1],$MinDate[2],$MinDate[0]);
	$MaxDate=explode('-',$DateFin);
	//Comme on gère les heures, la derniere journée sera à 23:59
	$MaxDate=mktime(23,59,59,$MaxDate[1],$MaxDate[2],$MaxDate[0]);
	if ($MinDate<$MaxDate)
	{
//Formatage des dates
		$TempDate1=new DateTime($DateDebut);
		$DateDebut=$TempDate1->format('d/m/Y');
		$TempDate1=new DateTime($DateFin);
		$DateFin=$TempDate1->format('d/m/Y');
		$Max=count($TabResultat);
		$dateUtils = new DateScaleUtils();
// We add some grace to the end of the X-axis scale so that the first and last
// data point isn't exactly at the very end or beginning of the scale
		$grace = 40;
		$xmin = $MinDate-$grace;
//	echo "<p>X min=$xmin</p>";
		$xmax = $MaxDate+$grace;
//	echo "<p>X max=$xmax</p>";
// Setup the graph
		$graph = new Graph($Width,$Height);
		$graph->SetScale('intlin',0,0,$xmin,$xmax); 
		$graph->title->Set($Titre);
		$graph->title->SetFont(FF_ARIAL,FS_NORMAL,12);
// Make sure that the X-axis is always at the bottom of the scale
		$graph->xaxis->SetPos('min');
		$graph->xaxis->SetLabelMargin(30);
		$graph->xaxis->SetLabelFormatCallback('formdate');
 // Use Ariel font
		$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,9);
		$graph->xaxis->SetLabelAngle(75);
// Add a X-grid
		$graph->xgrid->Show();
// Create the plot line
		$k=0;
		$TableInt=array();
		$TableExt=array();
		$TableDate=array();	
		foreach ($TabResultat as $TabRecolte)
			{
				$TableInt[$k]=$TabRecolte['Valeur_Int'];
				$TableExt[$k]=$TabRecolte['Valeur_Ext'];
				$TableDate[$k]=$TabRecolte['LaDate'];
				$k++;
			}
			//Creation du point
			$P1=new LinePlot($TableInt,$TableDate);		
			$P1->SetColor('teal');
			$P1->SetLegend($theme.' Intérieure');
			$graph->Add($P1);
			$P2=new LinePlot($TableExt,$TableDate);		
			$P2->SetColor('black');
			$P2->SetLegend($theme.' Extérieure');
			$graph->Add($P2);
		
// Output graph
		$XLegend=$Width-($Width/3);
		$YLegend=45;
		$graph->legend->SetAbsPos($XLegend,$YLegend,'center','bottom');
		$graph->Stroke($Destination);
	}
}
function DrawGraph1Courbe($DateDebut,$DateFin,$TabResultat,$Width,$Height,$Titre,$theme,$Destination)
{
	$MinDate=explode('-',$DateDebut);
	$MinDate=mktime(0,0,0,$MinDate[1],$MinDate[2],$MinDate[0]);
	$MaxDate=explode('-',$DateFin);
	//Comme on gère les heures, la derniere journée sera à 23:59
	$MaxDate=mktime(23,59,59,$MaxDate[1],$MaxDate[2],$MaxDate[0]);
	if ($MinDate<$MaxDate)
	{
//Formatage des dates
		$TempDate1=new DateTime($DateDebut);
		$DateDebut=$TempDate1->format('d/m/Y');
		$TempDate1=new DateTime($DateFin);
		$DateFin=$TempDate1->format('d/m/Y');
		$Max=count($TabResultat);
		$dateUtils = new DateScaleUtils();
// We add some grace to the end of the X-axis scale so that the first and last
// data point isn't exactly at the very end or beginning of the scale
		$grace = 40;
		$xmin = $MinDate-$grace;
//	echo "<p>X min=$xmin</p>";
		$xmax = $MaxDate+$grace;
//	echo "<p>X max=$xmax</p>";
// Setup the graph
		$graph = new Graph($Width,$Height);
		$graph->SetScale('intlin',0,0,$xmin,$xmax); 
		$graph->title->Set($Titre);
		$graph->title->SetFont(FF_ARIAL,FS_NORMAL,12);
// Make sure that the X-axis is always at the bottom of the scale
		$graph->xaxis->SetPos('min');
		$graph->xaxis->SetLabelMargin(30);
		$graph->xaxis->SetLabelFormatCallback('formdate');
 // Use Ariel font
		$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,9);
		$graph->xaxis->SetLabelAngle(75);
// Add a X-grid
		$graph->xgrid->Show();
// Create the plot line
		$k=0;
		$TableInt=array();
		$TableExt=array();
		$TableDate=array();	
		foreach ($TabResultat as $TabRecolte)
			{
				$TableValeur[$k]=$TabRecolte['Valeur'];
				$TableDate[$k]=$TabRecolte['LaDate'];
				$k++;
			}
			//Creation du point
			$P1=new LinePlot($TableValeur,$TableDate);		
			$P1->SetColor('teal');
			$P1->SetLegend($theme);
			$graph->Add($P1);
		
// Output graph
		$XLegend=$Width-($Width/3);
		$YLegend=45;
		$graph->legend->SetAbsPos($XLegend,$YLegend,'center','bottom');
		$graph->Stroke($Destination);
	}
}
?>