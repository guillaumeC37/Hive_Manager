<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	carto_rucher.php								 *
 * Date création :	26/05/2018										 *
 * Date Modification :	26/05/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Selectionne le fond d'image pour le rucher						 *
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
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$Id_Rucher=$_SESSION['ID_Rucher'];
		$ID_Api=$_SESSION['ID_API'];
		if ($Id_Rucher>0)
		{
			//On regarde si on a une image à enregistrer
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			if (isset($_POST['nom_fiche']))
			{
				//On traite l'image
				$Erreur=0;
				//On  verifie le fichier et au cas ou, on l'enregistre
				$FileOk=false;
				$ExtFile='';
				if (isset($_FILES['chem_fiche']))
				{
					if($_FILES['chem_fiche']['error']==0)
					{
						//On a bien un fichier, on vérifie si c'est bien un png ou un jpg
						$Fichier=$_FILES['chem_fiche']['tmp_name'];
						$TypeFichier=mime_content_type ( $Fichier);
						if(($TypeFichier=="image/png") or($TypeFichier=="image/jpeg"))
						{
							if($TypeFichier=="image/png")
								$ExtFile='.png';
							if($TypeFichier=="image/jpeg")
								$ExtFile='.jpg';
						}
						else
							$Erreur=1;						
					}
					else
						$Erreur=1;
				}
				else
					$Erreur=1;
				if($Erreur==0)
				{
						$FileOk=true;
				}
				//Formatage du nom du fichier
				$NomFichier=htmlspecialchars($_POST['nom_fiche'],ENT_NOQUOTES,'UTF-8');
				if ($NomFichier=='')
				{
					//On donne un nom arbitraire
					$NomFichier="carto".rand(0,100)."_$ID_Api";
				}
				$NomFichier=$Id_Rucher.'-'.$NomFichier;
				$CheminComplet=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/images/carto/$ID_Api/".$NomFichier.$ExtFile;
				//On créé le fichier
				if ($FileOk)
				{
					//Copie et renommage du fichier
					if(!(move_uploaded_file($_FILES['chem_fiche']['tmp_name'],$CheminComplet)))
						$NomFichier='';
				}
				else
					$NomFichier='';
				//Si $NomFichier<>'' on inscrit dans la base
				if($NomFichier!='')
				{
					//On inscrit dans la base
					$NomImage=$NomFichier.$ExtFile;
					$TableValeur=array(':IDRUCHER'=>$Id_Rucher,':Nom_Image'=>$NomImage);
					//On prépare la requete
					$SQLS="CALL P_Update_Image_Rucher(:Nom_Image,:IDRUCHER)";
					$query=$DBConn->prepare($SQLS);
					//Execute la requete
					$query->execute($TableValeur); 
					$count=$query->rowCount();
					if($count==1)
					{
						 $template->assign('Resultat','Modification effectu&eacute;e');//OK
					}
					else
					{
						   $template->assign('Resultat','Erreur lors de la modification');//pas OK
					}
				}
				//
			}
			//Récupération des infos nécessaires du rucher
			$SQLS="SELECT Nom_Rucher, Num_Rucher, Path_Image FROM Rucher WHERE ID_Rucher=".$Id_Rucher;
			foreach($DBConn->query($SQLS) as $row)
			{
				$NomRucher=$row['Nom_Rucher'];
				$NumRucher=$row['Num_Rucher'];
				$Image_Rucher=$row['Path_Image'];
			}
			$template->assign('NomRucher',$NomRucher);
			$template->assign('NumRucher',$NumRucher);
			//Si l'image du rucher est vide :
			if($Image_Rucher!='')
			{	
				//On charge le canvas rucher.
				$CheminImageComplet="images/carto/$ID_Api/".$Image_Rucher;
				$template->assign('NomPhoto',$CheminImageComplet);		
			}
			$Page=$CheminTpl.'carto_vierge.tpl';
		}  //fin de if on est dans le rucher
		else
		{ //On est pas dans le rucher
			$Page=$CheminTpl.'erreur_rucher.tpl';
		}
		//On parse la page
		$template->display($Page);
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