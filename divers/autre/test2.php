<?php
	include "../include/config.inc.php";
	include "../include/function.inc.php";
	$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
	//récupère le tableau des styles de la BDD
	$SQLS="SELECT Nom_Template FROM Templates ORDER BY Nom_Template";
	$TabSQL=array();
	foreach($DBConn->query($SQLS) as $row)
	{
		array_push($TabSQL,$row['Nom_Template']);	
	}	
	$Rep=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/style";
	$D=opendir($Rep);
	rewinddir($D);
	while ($e=readdir($D))
	{
		$item=$Rep.'/'.$e;
		if(is_dir($item) and ($e!='.') and($e!='..'))
		{
			if(!in_array($e,$TabSQL))
			{
				$SQLS="INSERT INTO Templates (Nom_Template) VALUES ('$e')";
				echo "<p>$SQLS</p>";
				$DBConn->query($SQLS);
			}
		}
	}
?>