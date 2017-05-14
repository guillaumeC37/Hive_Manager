<?php   // content="text/plain; charset=utf-8"
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	draw_single.php									 *
 * Date création :	03/03/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère le graphe de récoltes de la ruche							 *
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
function DrawGraph($DateDebut,$DateFin,$TabResultat,$Width,$Height,$Titre,$Destination)
{
	$MinDate=explode('-',$DateDebut);
	$MinDate=mktime(0,0,0,$MinDate[1],$MinDate[2],$MinDate[0]);
	$MaxDate=explode('-',$DateFin);
	$MaxDate=mktime(0,0,0,$MaxDate[1],$MaxDate[2],$MaxDate[0]);
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
		$xmax = $MaxDate+$grace;
// Setup the graph
		$graph = new Graph($Width,$Height);
		$graph->SetScale('intlin',0,0,$xmin,$xmax); 
		$graph->title->Set($Titre);
		$graph->title->SetFont(FF_ARIAL,FS_NORMAL,12);
// Make sure that the X-axis is always at the bottom of the scale
		$graph->xaxis->SetPos('min');
		$graph->xaxis->SetLabelMargin(10);
		$graph->xaxis->SetLabelFormatCallback('formdate');
 // Use Ariel font
		$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,9);
		$graph->xaxis->SetLabelAngle(75);
// Add a X-grid
		$graph->xgrid->Show();
// Create the plot line	
		//On split le tableau d'un coté les dates, de l'autre les valeurs
		foreach($TabResultat as $key=>$row)
		{
			$LaDate  = explode('-',$row['Date']);
			//Formattage de la date en timestamp
			$MaDate=mktime(0,0,0,$LaDate[1],$LaDate[2],$LaDate[0]);
			$Date[$key]=$MaDate;
			$Temperature[$key] = $row['valeur'];
						
		}
		$P=new LinePlot($Temperature,$Date);
		$graph->Add($P);
// Output graph
		$XLegend=$Width-($Width/2);
		$YLegend=40;
		$graph->legend->SetAbsPos($XLegend,$YLegend,'center','bottom');
		$graph->Stroke($Destination);
	}
}
