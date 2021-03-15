<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	recolte.php										 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère une nouvelle récolte										 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  $template=new Smarty(); 
  $CheminTpl='../templates/';
//On verifie si on est dans la session
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];
  }
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
	if (isset($_SESSION['ID_Ruche']))
	{
		$IdRuche=$_SESSION['ID_Ruche'];
		$ID_Api=$_SESSION['ID_API'];
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		if (isset($_POST['Add_Recolte']))
		{
			//On met en forme les données recues
			$erreur=0;
			if (isset($_POST['dateRecolte']))
			{
				$LaDate=htmlspecialchars($_POST['dateRecolte'],ENT_NOQUOTES,'UTF-8');
				$LaDate=convertDate($LaDate,0);
			}
			else
				$erreur=1;
			if (isset($_POST['Type_Miel']))
			{
				//Cas ou type miel=-1
				$ID_Type_Miel=(int)$_POST['Type_Miel'];
				if($ID_Type_Miel==-1)
				{
					if (isset($_POST['Temp_Miel']))
					{
						//On ajoute le nouveau miel à la base.
						$NouveauMiel=htmlspecialchars($_POST['Temp_Miel'],ENT_NOQUOTES,'UTF-8');
						$SQLS="INSERT INTO type_miel (ID_Api,Nom_Type_Miel) VALUES (:Api,:NomType)";
						$TableTemp=array(':NomType'=>$NouveauMiel,':Api'=>$ID_Api);
						$query=$DBConn->prepare($SQLS);
						$query->execute($TableTemp); 
						$count=$query->rowCount();
						if ($count==1)
						{
							$ID_Type_Miel=(int) $DBConn->lastInsertId();
						}
						else
						{
							$erreur=1;
						}
					}
					else
						$erreur=1;
				}//Fin cas -1 type miel				
			}
			else
				$erreur=1;

			if (isset($_POST['Poids']))
			{
				$LePoids=(int)$_POST['Poids'];
			}
			else
				$erreur=1;
			if($erreur==0)
			{
				//On ajoute la récolte à la base
				$MaTable=array(':ID_Ruche'=>$IdRuche,':ID_Miel'=>$ID_Type_Miel,':LaDate'=>$LaDate,':Poids'=>$LePoids);
				/*echo "<pre>";
				print_r($MaTable);
				echo "</pre>";*/
				$SQLS="CALL P_Add_Recolte(:ID_Ruche,:ID_Miel,:LaDate,:Poids)";
				$query=$DBConn->prepare($SQLS);
				//On ajoute à la base
				$query->execute($MaTable); 
				$count=$query->rowCount();
				if ($count==1)
				{
					$template->display($CheminTpl.'recolte_ajoutee.tpl');
				}
				else
				{
					$template->display($CheminTpl.'recolte_erreur.tpl');
				}
			}
			else //erreur=1
			{
				//erreur d'ajout
				$template->display($CheminTpl.'recolte_erreur.tpl');
			}
		} //fin on a recu quelque chose du formulaire
		else
		{
			//On parse la page d'ajout
			$SQLS="SELECT Nom_Ruche FROM ruche WHERE ID_Ruche=$IdRuche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$NomRuche=$row['Nom_Ruche'];
			}
			// $ Nom_Miel Id_Miel 
			//tempo
			$ListeMiel=array();
			$SQLS="SELECT ID_Type_Miel, Nom_Type_Miel FROM type_miel WHERE ID_Api=$ID_Api ORDER BY Nom_Type_Miel";
			$i=0;
			foreach($DBConn->query($SQLS) as $row)
			{
				$ListeMiel[$i]['Id_Miel']=$row['ID_Type_Miel'];
				$ListeMiel[$i]['Nom_Miel']=$row['Nom_Type_Miel'];
				$i++;
			}
			/*$ListeMiel[0]['Id_Miel']=1;
			$ListeMiel[0]['Nom_Miel']='Toutes fleurs';*/
			$template->assign('Nom_Ruche',$NomRuche);
			$template->assign('liste_miel',$ListeMiel);
			$Page=$CheminTpl.'recolte.tpl';
			$template->display($Page);
		}
	} //Fin session ID Ruche OK
	else
	{
		//No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	}
	  //On parse la page
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page
	  $Page=$CheminTpl.'erreur.tpl';
	  $template->display($Page);
  }
    //traitement quoi qu'il en soit
  $Pied=new Smarty(); 
  $DBConn2=connectbase($userdb,$passdb,$servdb,$nomdb);
  $SQLS="SELECT Value_Param FROM param WHERE Nom_Param='Version'";
  foreach($DBConn2->query($SQLS) as $row)
  {
	$Version=$row['Value_Param'];  
  }
  $Pied->Assign('Version',$Version);
  $Pied->display($CheminTpl.'pied.tpl');
?>  