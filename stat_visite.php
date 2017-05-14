<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	stat_visite.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Génère la liste des visites entre 2 dates						 *
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
	if(isset($_SESSION['ID_Ruche']))
	{
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$Id_Ruche=$_SESSION['ID_Ruche'];
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$Id_Ruche";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomRuche=$row['Nom_Ruche'];  
		}
		//parse
		$template->Assign('Nom_Ruche',$NomRuche);
		if(isset($_POST['Rech_visite']))
		{
			//Formatage de la requete en fonction des dates
			$ClauseWhere='';
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
			switch($IdWhere)
			{
				case 0 : //On a rien
					$ClauseWhere='';
					$DateDebutAff='01/01/1900';
					$DateFinAff=date('d/m/Y');
					$template->Assign('DateDebut',$DateDebutAff);
					$template->Assign('DateFin',$DateFinAff);
					break;
				case 1 : //AND Date_Visite>DateDebut
					$ClauseWhere="AND Date_Visite>='$DateDebut'";
					$template->Assign('DateDebut',$DateDebutAff);
					$DateFinAff=date('d/m/Y');
					$template->Assign('DateFin',$DateFinAff);
				break;
				case 2 : //AND Date_Visite<DateFin
					$ClauseWhere="AND Date_Visite<='$DateFin'";
					$DateDebutAff='01/01/1900';
					$template->Assign('DateDebut',$DateDebutAff);
					$template->Assign('DateFin',$DateFinAff);
				break;
				case 3 :  //AND Date_Visite BETWEEN
					$ClauseWhere="AND Date_Visite BETWEEN '$DateDebut' AND '$DateFin'";
					$template->Assign('DateDebut',$DateDebutAff);
					$template->Assign('DateFin',$DateFinAff);
				break;
			}
			$_SESSION['Date_Debut']=$DateDebutAff;
			$_SESSION['Date_Fin']=$DateFinAff;
			$SQLS="SELECT Temperature,Hygro,Travaux,Nourrissage,Type_Nourrissage,Poids,Reine_Visible,Population,Comportement,Notes,Date_Visite,Presence_Maladie,Nom_Maladie,Climat FROM vue_visite WHERE Id_Ruche=$Id_Ruche $ClauseWhere ORDER BY Date_Visite ASC";
			$i=0;
			$TableVisite=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				//Dans la boucle, en ce qui concerne les cases à cocher il faut traiter autrement que comme cela
				$LaDate=convertDate($row['Date_Visite'],1);
				$TableVisite[$i]['Date_V']=$LaDate;
				$TableVisite[$i]['Numero']=$i;
				if($row['Comportement']=='')
				{
					$Comportement='Non renseign&eacute;';
				}
				else
					$Comportement=$row['Comportement'];
				$TableVisite[$i]['Comportement']=$Comportement;
				if($row['Population']=='')
				{
					$population='Non renseign&eacute;';
				}
				else
					$population=$row['Population'];
				$TableVisite[$i]['Population']=$population;
				if($row['Presence_Maladie']==0)
				{
					$Maladie='Aucune';
					$NomMaladie='';
				}
				else
				{
					$Maladie='Oui :';  //A changer par autre chose de plus "visuel"
					$NomMaladie=$row['Nom_Maladie'];
				}
				$TableVisite[$i]['Maladie']=$Maladie;
				$TableVisite[$i]['NomMaladie']=$NomMaladie;
				if($row['Reine_Visible']==0)
				{
					$Visible='Non';
				}
				else
				{
					$Visible='Oui';
				}
				$TableVisite[$i]['ReineVisible']=$Visible;
				if($row['Poids']==0)
				{
					$poids='Non mesur&eacute;';
				}
				else
				{
					$poids=$row['Poids'].' kg';
				}
				$TableVisite[$i]['Poids']=$poids;
				if($row['Temperature']==-100)
				{
					$temp='Non mesur&eacute;e';
				}
				else
					$temp=$row['Temperature'].'&deg;C';
				$TableVisite[$i]['Temperature']=$temp;
				$TableVisite[$i]['Climat']=$row['Climat'];
				if ($row['Hygro']==0)
				{
					$Hygro='Non mesur&eacute;e';
				}
				else
					$Hygro=$row['Hygro'].'%';
				$TableVisite[$i]['Hygro']=$Hygro;
				if ($row['Nourrissage']==0)
				{
					$Nourrissage='Non effectu&eacute;';
				}
				else
					$Nourrissage='Oui :';
				$TableVisite[$i]['Nourrissage']=$Nourrissage;
				$TableVisite[$i]['Type_Nourrissage']=$row['Type_Nourrissage'];
				if($row['Travaux']==0)
				{
					$Travaux='non';
				}
				else
					$Travaux='oui';
				$TableVisite[$i]['Travaux']=$Travaux;
				if($row['Notes']=='')
				{
					$Notes='Aucunes';
				}
				else
					$Notes=$row['Notes'];
				$TableVisite[$i]['Notes']=$Notes;  
				$i++;
			}
			$template->Assign('liste_visite',$TableVisite);
			$Page=$CheminTpl.'stat_visite.tpl';
			$template->display($Page);
		}  //Fin post recherche
		else
		{
			if (isset($_SESSION['Date_Debut']))
			{
				//On prend des précautions avec les valeurs
				unset($_SESSION['Date_Debut']);
				unset($_SESSION['Date_Fin']);
			}
			$Page=$CheminTpl.'rech_visite.tpl';
			$template->display($Page);
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