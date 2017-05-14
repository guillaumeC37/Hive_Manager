<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	function.inc.php								 *
 * Date création :	01/02/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Regroupe les fonctions utilisées									 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 function connectbase($user,$pass,$serveur,$base)
{
	$temp=new PDO('mysql:host='.$serveur.';dbname='.$base,$user,$pass,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
	return $temp;
}
function convertDate($OldDate,$typeD)
  {
    
	switch($typeD)
    {
      case 0 : $format = '#^[0-3][0-9]/[0-1][0-9]/[0-9]{4}$#';
	           if (preg_match( $format , $OldDate )) //on vérifie que la date à bien un format de type jj/mm/aaaa
	           {
				   $TabDate=explode('/',$OldDate);      //On convertit PHP->Mysql
                   $DateBase=$TabDate[2].'-'.$TabDate[1].'-'.$TabDate[0];
			   }
			   else
	           {
	              $DateBase= date("Y-m-d");//date de ce jour;
	           }
               break;
      case 1 : $TabDate=explode('-',$OldDate);      //On convertit Mysql->PHP
               $DateBase=$TabDate[2].'/'.$TabDate[1].'/'.$TabDate[0];
               break;
      default : $DateBase=$OldDate;
    }
    return $DateBase;
  }
function Isbissextile($annee)
{
	if( (is_int($annee/4) && !is_int($annee/100)) || is_int($annee/400)) {
		return TRUE;
	} else {
		return FALSE;
	}
}
function NombreMois($datedebut,$datefin)
{
	$datetime1 = new DateTime($datedebut);
	$datetime2 = new DateTime($datefin);
	$interval = $datetime1->diff($datetime2);
	$NbreJour=$interval->format('%d');
	$Ajoute=0;
	if($NbreJour>0)
	{
		$Ajoute=1;
	}
	$NbreMois=$interval->format('%m');
	$Year=$interval->format('%y');
	//Si on a plus d'un an, ou un an juste
	if($Year>0)
	{
		$Ajoute+=12*$Year;
	}
	$NbreMois+=$Ajoute;
	return($NbreMois);
} 
function verifVersion($LaVersion,$userdb,$passdb,$servdb,$nomdb)
{
	
	$DBConn2=connectbase($userdb,$passdb,$servdb,$nomdb);
	$SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Version'";
	foreach($DBConn2->query($SQLS) as $row)
	{
		$Version=$row['Value_Param'];  
	}
	$retour=false;
	if($LaVersion==$Version)
		$retour=true;
	return($retour);
}
?>