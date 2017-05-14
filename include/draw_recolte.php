<?php   // content="text/plain; charset=utf-8"
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	draw_recolte.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Je ne sais pas si ce fichier est utile							 *
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
		foreach ($TabResultat as $Key=>$TabMesure)
		{
			$k=0;
			${'TablePoids'.$Key}=array();
			${'TableDate'.$Key}=array();
			foreach ($TabMesure as $TabRecolte)
			{
				${'TablePoids'.$Key}[$k]=$TabRecolte['LePoids'];
				$LaDate=explode('-',$TabRecolte['Date_R']);
				$MaDate=mktime(0,0,0,$LaDate[1],$LaDate[2],$LaDate[0]);
				${'TableDate'.$Key}[$k]=$MaDate;
				${'Nom'.$Key}=$TabRecolte['LeNom'];
				$k++;
			}
			//Creation du point
			${'p'.$Key}=new LinePlot(${'TablePoids'.$Key},${'TableDate'.$Key});		
			${'p'.$Key}->SetColor('teal');
			${'p'.$Key}->SetLegend( ${'Nom'.$Key});
			$graph->Add(${'p'.$Key});
		}
// Output graph
		$XLegend=$Width-($Width/3);
		$YLegend=40;
		$graph->legend->SetAbsPos($XLegend,$YLegend,'center','bottom');
		$graph->Stroke($Destination);
	}
}
