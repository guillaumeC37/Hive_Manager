<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	gestion_miel.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Depuis la page apiculteur gère la liste des types de miel		 *
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
echo "<p>Files</p>";
print_r($_FILES);
echo "</pre>";
*/
	if(isset($_SESSION['ID_API']))
	{
		$ID_Api=$_SESSION['ID_API'];
		$TemplateUser=$_SESSION['Template_User'];
		$template->assign('TemplateUser',$TemplateUser);
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		if(isset($_POST['Modif_Form']))
		{
			//On doit modifier dans la base
			/*
			Miel_Selected->Id du miel
			NomType->Nom du nouveau
			ModifIcone->Case à cochée
			dans files, $_FILES['Photo']
			Array :
			->name
			->type  image/png ou image/jpeg
			->tmp_name, là ou est stocké temporairement le fichier
			->Error (doit etre à 0)
			->Size
			*/
			//On verifie si le fichier est OK
			$Erreur=0;
			//On  verifie le fichier et au cas ou, on l'enregistre
			$FileOk=false;
			$ExtFile='';
			if (isset($_FILES['Photo']))
			{
				if($_FILES['Photo']['error']==0)
				{
					//On a bien un fichier, on vérifie si c'est bien un png ou un jpg
					$Fichier=$_FILES['Photo']['tmp_name'];
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
			if (isset($_POST['ModifIcone']))
			{
				//On a cocher la case modifier l'icone
				//On récupère  l'id du type à modifier
				$ID_TypeModif=(int) $_POST['Miel_Selected'];
				if (($ID_TypeModif>0)&&($FileOk))
				{
					//On est sur qu'on a choisit un champ
					//On récupère le nom du type choisi
					$SQLS="SELECT Nom_Type_Miel FROM type_miel WHERE ID_Type_Miel=:Modif";
					$MaTable=array(':Modif'=>$ID_TypeModif);
					$query=$DBConn->prepare($SQLS);
					$query->execute($MaTable);
					$Compte=$query->rowCount();
					if ($Compte==1)
					{
						//On execute la requete
						while($row=$query->fetch())
						{
							//On récupère le nom
							$LeNom=$row['Nom_Type_Miel'];
						}
						$NomFichier=str_replace(' ','_',$LeNom);
						$CheminComplet=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/images/graph/$ID_Api/".$NomFichier.$ExtFile;
						if(move_uploaded_file($_FILES['Photo']['tmp_name'],$CheminComplet))
						{
							//On a put changer de nom, donc créer le fichier, alors on upadte la table
							$SQLS="UPDATE type_miel SET Nom_Image='$NomFichier' WHERE ID_Type_Miel=:Modif";
							$MaTable=array(':Modif'=>$ID_TypeModif);
							$query=$DBConn->prepare($SQLS);
							$query->execute($MaTable);
						}
					}
				}
				
			}
			else
			{
				//On ajoute un type
				if (isset($_POST['NomType'])&&($_POST['NomType']!=''))
				{
					$NouveauMiel=htmlspecialchars($_POST['NomType'],ENT_NOQUOTES,'UTF-8');
					if ($FileOk)
					{
						//Copie et renommage du fichier
						$NomFichier=str_replace(' ','_',$NouveauMiel);
						$CheminComplet=$_SERVER['DOCUMENT_ROOT']."Gestion_rucher/images/graph/$ID_Api/".$NomFichier.$ExtFile;
						if(!(move_uploaded_file($_FILES['Photo']['tmp_name'],$CheminComplet)))
							$NomFichier='';
					}
					else
						$NomFichier='';
					$SQLS="INSERT INTO type_miel (ID_Api,Nom_Type_Miel,Nom_Image) VALUES (:Api,:NomType,:NomImage)";
					$TableTemp=array(':NomType'=>$NouveauMiel,':Api'=>$ID_Api,':NomImage'=>$NomFichier);
					$query=$DBConn->prepare($SQLS);
					$query->execute($TableTemp); 
				}
				else
				{
					//Erreur car pas de nom spécifié
					////
					$SQLS="SELECT ID_Type_Miel, Nom_Type_Miel,Nom_Image FROM type_miel WHERE ID_Api=$ID_Api ORDER BY Nom_Type_Miel";
					$i=0;
					foreach($DBConn->query($SQLS) as $row)
					{
						$ListeMiel[$i]['Id_Miel']=$row['ID_Type_Miel'];
						$ListeMiel[$i]['Nom_Miel']=$row['Nom_Type_Miel'];
						$NomImage=$row['Nom_Image'];
						if ($NomImage=='')
						{
							$NomImage='noimage';
						}
						$NomImage="images/graph/$ID_Api/".$NomImage.'.png';
						$ListeMiel[$i]['Nom_Image']=$NomImage;
						$i++;
					}
					//On affiche la page telle quelle
					$template->assign('liste_miel',$ListeMiel);
					$Page=$CheminTpl.'ges_miel.tpl';
					$template->display($Page);
					//////
				}
			}
		}
		$SQLS="SELECT ID_Type_Miel, Nom_Type_Miel,Nom_Image FROM type_miel WHERE ID_Api=$ID_Api ORDER BY Nom_Type_Miel";
		$i=0;
		foreach($DBConn->query($SQLS) as $row)
		{
			$ListeMiel[$i]['Id_Miel']=$row['ID_Type_Miel'];
			$ListeMiel[$i]['Nom_Miel']=$row['Nom_Type_Miel'];
			$NomImage=$row['Nom_Image'];
			if ($NomImage=='')
			{
				$NomImage='noimage';
			}
			$NomImage="images/graph/$ID_Api/".$NomImage.'.png';
			$ListeMiel[$i]['Nom_Image']=$NomImage;
			$i++;
		}
		//On affiche la page telle quelle
		$template->assign('liste_miel',$ListeMiel);
		$Page=$CheminTpl.'ges_miel.tpl';
		$template->display($Page);		
	}//Fin if isset ID_API
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