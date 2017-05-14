<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	creer_essaimphp									 *
 * Date création :													 *
 * Date Modification :	08/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Créer un essaim et l'affecte  à la ruche							 *
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
/* Pour debug
echo "<pre> Session :";
print_r ($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";  
*/		  
	$TemplateUser=$_SESSION['Template_User'];
	$template->assign('TemplateUser',$TemplateUser);
	if (isset($_POST['creer_essaim']))
	{
        //On créé l'essaim		
		$ErreurPost=0;
		if(isset($_POST['Nom_Essaim']))
		{
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			$ID_Api=$_SESSION['ID_API'];
			$ID_Ruche=$_SESSION['ID_Ruche'];
			$NomEssaim=htmlspecialchars($_POST['Nom_Essaim'],ENT_NOQUOTES,'UTF-8');
			//On vérifie que le couple Nom Essaim+ID Api n'existe pas dans la base
			$SQLS="SELECT count(*) as Nombre FROM essaim WHERE Nom_ESSAIM='$NomEssaim' AND Id_apiculteur=$ID_Api";
			foreach($DBConn->query($SQLS) as $row)
			{
			    $Compte=$row['Nombre'];  
			}
			if ($Compte>0)
			{
				//L'essaim existe déjà
				$Page=$CheminTpl.'essaim_existe.tpl';
			}
			else  //Essaim n'existe pas
			{
				//////////////////
			//On construit la requete SQL d'ajout
				if(isset($_POST['Espece']))
				{
				   $Espece=htmlspecialchars($_POST['Espece'],ENT_NOQUOTES,'UTF-8');
				}
				else
				   $Espece='';
				if(isset($_POST['DateC']))
				{
				   $DateE=htmlspecialchars($_POST['DateC'],ENT_NOQUOTES,'UTF-8');
				   $DateE=convertDate($DateE,0);
				}
				else
				   $DateE=date('Y-m-d');
				if(isset($_POST['LieuC']))
				{
				   $Lieu=htmlspecialchars($_POST['LieuC'],ENT_NOQUOTES,'UTF-8');
				}
				else
				   $Lieu='';
				if(isset($_POST['Age_R']))
				{
				   $Age=htmlspecialchars($_POST['Age_R'],ENT_NOQUOTES,'UTF-8');
				   if(filter_var( $Age, FILTER_VALIDATE_INT) === false)
					   $Age='';
				}
				else
				   $Age='';
				if(isset($_POST['Or_R']))
				{
				   $Or_reine=htmlspecialchars($_POST['Or_R'],ENT_NOQUOTES,'UTF-8');
				   if(filter_var( $Or_reine, FILTER_VALIDATE_INT) === false)
					   $Or_reine=-1; //Si on a insufflé une mauvaise variable, on créera forcément une erreur SQL
				}
				else
				   $Or_reine='';
				if(isset($_POST['OriE']))
				{
				   $Origine=$_POST['OriE'];
				}
				else
				   $ErreurPost=1;
			    if($ErreurPost==0)  //Si on a pas eu d'erreur jusqu'ici
				{
						$TableInsert=array(':Nom'=>$NomEssaim,':Ruche'=>$ID_Ruche,':Api'=>$ID_Api,':Espece'=>$Espece,':Origine'=>$Origine,':DateE'=>$DateE,':AgeR'=>$Age,':OrR'=>$Or_reine,':Lieu'=>$Lieu);
						$SQLS="CALL P_Add_Essaim(:Nom,:Ruche,:Api,:Espece,:Origine,:DateE,:AgeR,:OrR,:Lieu)";
						$query=$DBConn->prepare($SQLS);
			            //On ajoute l'essaim à la base
	                    $query->execute($TableInsert);
						//On vérifie l'ajout
						$SQLS="SELECT count(*) as Nombre FROM essaim WHERE Nom_ESSAIM='$NomEssaim' AND Id_apiculteur=$ID_Api";
					    foreach($DBConn->query($SQLS) as $row)
					    {
				            $Compte=$row['Nombre'];  
						}
						if ($Compte==1)
						{
							//Ajout de l'essaim OK
							//On modifie l'état de la ruche 
							$SQLS="UPDATE ruche SET ID_ETAT=$RucheActive WHERE ID_Ruche=$ID_Ruche";
							$query=$DBConn->prepare($SQLS);
							$query->execute();
							$Page=$CheminTpl.'essaim_ajoute.tpl';
						} 
						else  //L'essaim n'existe pas
						{
							$ErreurPost=1;
						}
				}  //Fin if Errorpost=0
				///////////////////////
			}//Fin essaim existe pas on créé


		} //Fin Isset Nom Essaim
		else //On a pas le nom
		{
			$ErreurPost=1;
		}
        if($ErreurPost!=0)  //Il y a eu une errreur
		{
			$Page=$CheminTpl.'essaim_erreur.tpl';  
		}
		$template->display($Page);		 
	  }//Fin de POST existe
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