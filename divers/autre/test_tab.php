<?php
$Table1=array();
$Table2=array();
for($i=0;$i<5;$i++)
{
	$x=rand(6888885552,996888885552);
	$Table1[$i]['poids']=$i;
	$Table11[$i]['poids']=$i;
	$Table2[$i]['poids']=$i+10;
	$Table22[$i]['poids']=$i+10;
	$madate=date('Y-m-d',$x);
	$Table1[$i]['date']=$x;
	$Table11[$i]['date']=$madate;
	$x=rand(6888885552,996888885552);
	$madate=date('Y-m-d',$x);
	$Table2[$i]['date']=$x;
	$Table22[$i]['date']=$madate;
}
$tabtotal=array_merge($Table11,$Table22);
foreach ($tabtotal as $key => $row) {
    $Date[$key]  = $row['date'];
    $Poids[$key] = $row['poids'];
}
array_multisort($Date,SORT_ASC,$Poids,SORT_ASC,$tabtotal);
$compte=count($tabtotal);

echo "<pre>";
print_r($Table11);
print_r($Table22);
print_r($tabtotal);
echo "</pre>";

?>