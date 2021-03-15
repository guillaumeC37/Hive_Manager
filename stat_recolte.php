<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_recolte.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère les stats de récoltes de la ruche							 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  include "include/draw_recolte2.php";
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
	  //On parse la page
	
	if(isset($_SESSION['ID_Ruche']))
	{
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$Id_Ruche=$_SESSION['ID_Ruche'];
		$Id_Api=$_SESSION['ID_API'];
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$Id_Ruche";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomRuche=$row['Nom_Ruche'];  
		}
		//parse
		$template->Assign('Ruche',$NomRuche);
		if(isset($_POST['Rech_recolte']))
		{
			//Récupère la date la plus ancienne de la base
			$SQLS="SELECT MIN(Date_R) AS Min_Date from recolte WHERE ID_Ruche=$Id_Ruche";
			foreach($DBConn->query($SQLS) as $row)
			{
				$DateMinDebut=$row['Min_Date'];
			}
			if ($DateMinDebut=='')
			{
				//Il n'y a aucune recolte
				$Page=$CheminTpl.'no_recolte.tpl';
				$template->display($Page);
			}
			else
			{
				$DateMinDebutAff=convertDate($DateMinDebut,1);
				//Formatage de la requete en fonction des dates
				$IdWhere=0;
				if (isset($_POST['DateDebut']))
				{
					$DateDebut=htmlspecialchars($_POST['DateDebut'],ENT_NOQUOTES,'UTF-8');
					if ($DateDebut!="")
					{
						$IdWhere=1;
						$DateDebutAff=$DateDebut;
						$DateDebut=convertDate($DateDebut,0);
					}
				}
				if (isset($_POST['DateFin']))
				{
					$DateFin=htmlspecialchars($_POST['DateFin'],ENT_NOQUOTES,'UTF-8');
					if($DateFin!="")
					{
						$DateFinAff=$DateFin;
						$IdWhere+=2;
						$DateFin=convertDate($DateFin,0);
					}
				}
//revoir cette partie, afin de faire un betwwen en controlant que Date1<Date2			
				switch($IdWhere)
				{
					case 0 : //On a rien
						$DateDebutAff=$DateMinDebutAff;
						$DateFinAff=date('d/m/Y');
						$DateFinSQL=date('Y-m-d');
						$DateDebutSQL=$DateMinDebut;
						$template->Assign('DateDebut',$DateDebutAff);
						$template->Assign('DateFin',$DateFinAff);
						break;
					case 1 : //AND Date_Visite>DateDebut
						$DateDebutSQL=$DateDebut;
						$template->Assign('DateDebut',$DateDebutAff);
						$DateFinAff=date('d/m/Y');
						$DateFinSQL=date('Y-m-d');
						$template->Assign('DateFin',$DateFinAff);
					break;
					case 2 : //AND Date_Visite<DateFin
						$DateFinSQL=$DateFin;
						$DateDebutSQL=$DateMinDebut;
						$DateDebutAff=$DateMinDebutAff;
						$template->Assign('DateDebut',$DateDebutAff);
						$template->Assign('DateFin',$DateFinAff);
					break;
					case 3 :  //AND Date_Visite BETWEEN
						$DateDebutSQL=$DateDebut;
						$DateFinSQL=$DateFin;
						$template->Assign('DateDebut',$DateDebutAff);
						$template->Assign('DateFin',$DateFinAff);
					break;
				}
				$ClauseWhere="AND Date_R BETWEEN '$DateDebutSQL' AND '$DateFinSQL'";
				$_SESSION['Date_Debut']=$DateDebutAff;
				$_SESSION['Date_Fin']=$DateFinAff;
				$template->assign('DateDebut',$DateDebutAff);
				$template->assign('DateFin',$DateFinAff);
				//Recherche du poids total de récolte de la ruche
				$SQLS="SELECT SUM(Poids) as Poids FROM Vue_recolte_api  WHERE Id_Ruche=$Id_Ruche $ClauseWhere";
				foreach($DBConn->query($SQLS) as $row)
				{
					$PoidsTotal=$row['Poids'];
				}
				if($PoidsTotal=='')
				{
					$PoidsTotal=0;
				}
				$template->assign('Poids_total',$PoidsTotal);
				//Recherche du poids par type de miel de la ruche
				$SQLS="SELECT SUM(Poids) as Poids,Nom_Type_Miel FROM Vue_recolte_api  WHERE Id_Ruche=$Id_Ruche $ClauseWhere GROUP BY ID_Type_Miel";
				$i=0;
				$PoidsPartType=array();
				foreach($DBConn->query($SQLS) as $row)
				{
					$PoidsPartType[$i]['Poids_Miel']=$row['Poids'];
					$PoidsPartType[$i]['TypeMiel']=$row['Nom_Type_Miel'];
					$i++;
				}
				$template->assign('liste_recolte',$PoidsPartType);
				//Génération du graphe
//Esssayer de récupérer date début comme la date la plus ancienne, au lieu de 2010
				$SQLS="SELECT MIN(Date_R) AS Min_Date from recolte WHERE ID_Ruche=$Id_Ruche";
				foreach($DBConn->query($SQLS) as $row)
				{
					$DateMinDebut=$row['Min_Date'];
				}
				//Mise en forme SQL des dates
				$DateGDebut=convertDate($_SESSION['Date_Debut'],0);
				//Conversion de date en timestamp pour comparaison
				$MinBaseTS=explode('-',$DateMinDebut);
				$MinDateTS=explode('-',$DateGDebut);
				$MinBaseTS=mktime(0,0,0,$MinBaseTS[1],$MinBaseTS[2],$MinBaseTS[0]);
				$MinDateTS=mktime(0,0,0,$MinDateTS[1],$MinDateTS[2],$MinDateTS[0]);
				if ($MinBaseTS>$MinDateTS)
				{
					$DateGDebut=$DateMinDebut;
				
				}
				$DateGFin=convertDate($_SESSION['Date_Fin'],0);
				$SQLS="SELECT Date_R,Poids,Id_Type_Miel,Nom_Type_Miel,Image FROM Vue_recolte_api WHERE (ID_Ruche=$Id_Ruche) and (Date_R BETWEEN '$DateGDebut' AND '$DateGFin') ORDER BY Date_R";
				$query=$DBConn->prepare($SQLS);
				$query->execute();
				$TabResultat=array();
				$i=0;
				while($data=$query->fetch())
				{
	
					$IdType=$data['Id_Type_Miel'];
					$TabResultat[$IdType][$i]['Date_R']=$data['Date_R'];
					$TabResultat[$IdType][$i]['LeNom']=$data['Nom_Type_Miel'];
					$TabResultat[$IdType][$i]['LePoids']=$data['Poids'];
					$TabResultat[$IdType][$i]['Image']=$data['Image'];
					$i++;
				}
				$DateDebutAff=convertDate($DateGDebut,1);
				$Titre="Relevé des récoltes de la ruche '$NomRuche' sur la période du $DateDebutAff au $DateFinAff";
				$Racine=$_SERVER['DOCUMENT_ROOT']."/documents/$Id_Api/temp/";
				if(!is_dir($Racine))
				{
					mkdir($Racine);
				}
				$Image='recolte.png';
				$Chemin=$Racine.$Image;
				if(file_exists($Chemin))
				{
					unlink($Chemin);
				}
				DrawGraph($DateGDebut,$DateGFin,$TabResultat,800,400,$Titre,$Chemin,$Id_Api);
				//Fin génération image
				$template->assign('graphique_recolte',"$Id_Api/temp/".$Image);
				$template->display($CheminTpl.'stat_recolte_ruche.tpl');
			}
		}
		else
		{			  
			$Page=$CheminTpl.'stat_ruche_rech_poids.tpl';
			$template->display($Page);
			if (isset($_SESSION['Date_Debut']))
			{
				//On prend des précautions avec les valeurs
				unset($_SESSION['Date_Debut']);
				unset($_SESSION['Date_Fin']);
			}
		}
	}
	else
	{
		  //No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	}
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