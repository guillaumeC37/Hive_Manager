<?php
  include "../include/config.inc.php";
  include "../include/function.inc.php";
  include "../include/bilan_pdf.inc.php";
  include "../include/draw_Recoltebilan.php";
					$Id_Ruche=5;
					$MinDate='2017-02-01';
					$NomRuche='ruche';
					$Id_Api=38;
					$GraphDir=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/documents/$Id_Api/temp/bilan/";
					$GrapheTempSuivi=$GraphDir.'temphygro.png';
					echo "<p>$GrapheTempSuivi</p>";
					$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
					$SQLS="SELECT HYGRO,Date_Visite from visite WHERE HYGRO>0 AND ID_Ruche=$Id_Ruche ORDER BY Date_Visite";
					$i=0;
					$TabVisiteTemp=array();
					foreach($DBConn->query($SQLS) as $row)
					{
						$TabVisiteTemp[$i]['Date']=$row['Date_Visite'];
						$TabVisiteTemp[$i]['valeur']=$row['HYGRO'];
						$i++;
					}
					$Titre="Relevé des températures de la ruche '$NomRuche'";
					//On supprime l'ancienne image, au cas où
					if(file_exists($GrapheTempSuivi))
					{
						unlink($GrapheTempSuivi);
					}
					//On appelle la fonction de création du graphe		
					DrawGraph_Single($MinDate,date('Y-m-d'),$TabVisiteTemp,800,400,$Titre,$GrapheTempSuivi);
?>