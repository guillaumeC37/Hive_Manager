<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	affecte_essaim.php								 *
 * Date création :													 *
 * Date Modification :	08/03/2017									 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	0.2A												 *
 * Objet et notes :													 *
 *	Affecte un essaim à la ruche									 *			 
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
	 if (isset($_POST['reaffecte']))
	 {
		//On a recu un ordre en POST
		$Action=(int)$_POST['reaffecte'];
		$erreur=0;
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		switch ($Action)
		{
			case 1 : //On réaffecte simplement, car la ruche n'a pas d'essaim
					if (isset($_POST['EssaimE']))
					{
						$NouveauEssaim=(int)$_POST['EssaimE'];
						$IdRuche=$_SESSION['ID_Ruche'];
						//On récupère l'ID de l'ancienne ruche donneuse
						$SQLS="SELECT ID_RUCHE FROM essaim WHERE ID_ESSAIM=$NouveauEssaim";
						foreach($DBConn->query($SQLS) as $row)
						{
							$ID_RucheMod=$row['ID_RUCHE'];  
						}
						//SQL Update essaim
						$SQLS="UPDATE essaim SET ID_RUCHE=$IdRuche WHERE ID_ESSAIM=$NouveauEssaim";
						$query=$DBConn->prepare($SQLS);
			            //On modifie base
	                    $query->execute();
						//On vérifie
						$SQLS="SELECT count(*) as Nombre FROM essaim WHERE ID_RUCHE=$IdRuche and ID_ESSAIM=$NouveauEssaim";
						foreach($DBConn->query($SQLS) as $row)
					    {
				            $Compte=$row['Nombre'];  
						}
						if ($Compte==1)
						{
							//Ajout OK
							//On modifie la ruche donneuse en conséquence
							$SQLS="UPDATE ruche SET ID_ETAT=$RucheMorte WHERE ID_Ruche=$ID_RucheMod";
							$query=$DBConn->prepare($SQLS);
							//On modifie base
							$query->execute();
							//On modifie l'état de la ruche receptrice en conséquence car elle avait pas d'essaim
							$SQLS="UPDATE ruche SET ID_ETAT=$RucheActive WHERE ID_Ruche=$IdRuche";
							$query=$DBConn->prepare($SQLS);
							//On modifie base
							$query->execute();
							$Page=$CheminTpl.'essaim_modifie.tpl';
						} 
						else  //L'essaim n'existe pas
						{
							$Page=$CheminTpl.'essaim_erreur.tpl';
						}
					}
					else  //Erreur genre no man's land
						$Page=$CheminTpl.'essaim_erreur.tpl';
					break;
			case 2 : //On supprime l'essaim existant et on réaffecte ensuite					
					if (isset($_POST['EssaimE']))
					{    
						$NEssaim=$_POST['EssaimE'];
						if(filter_var( $NEssaim, FILTER_VALIDATE_INT) === false)
							$NEssaim=-1;
						$NouveauEssaim=$NEssaim; //Créer une erreur en cas d'insertion de mauvaise valeur
						$AncienEssaim=$_SESSION['ID_Essaim'];
						$IdRuche=$_SESSION['ID_Ruche'];
						//On récupère l'ID de la ruche donneuse
						$SQLS="SELECT ID_RUCHE FROM essaim WHERE ID_ESSAIM=$NouveauEssaim";
						foreach($DBConn->query($SQLS) as $row)
						{
							$ID_RucheMod=$row['ID_RUCHE'];  
						}
						$SQLS="DELETE FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
						//execute la suppression
						$query=$DBConn->prepare($SQLS);
						$query->execute();
						//Controle de la suppression
						$SQLS="SELECT count(*) as Compte FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
						foreach($DBConn->query($SQLS) as $row)
						{
							$Compte=$row['Compte'];
						}
						if ($Compte==0)
						{
							//OK, on a bien supprimer, on passe à la suite
							//Re affecte l'essaim à la ruche
							$SQLS="UPDATE essaim SET ID_RUCHE=$IdRuche WHERE ID_ESSAIM=$NouveauEssaim";
							//Exécution de la requete
							$query=$DBConn->prepare($SQLS);
							$query->execute();
							//On vérifie la réaffactation
							$SQLS="SELECT count(*) as Compte FROM essaim WHERE ID_RUCHE=$IdRuche and ID_ESSAIM=$NouveauEssaim";
							foreach($DBConn->query($SQLS) as $row)
							{
								$Compte=$row['Compte'];
							}
							if ($Compte==1)
							{
								//OK
								//On modifie la ruche donneuse en conséquence
								$SQLS="UPDATE ruche SET ID_ETAT=$RucheMorte WHERE ID_Ruche=$ID_RucheMod";
								$query=$DBConn->prepare($SQLS);
								//On modifie base
								$query->execute();
								$Page=$CheminTpl.'essaim_modifie.tpl';
							}
							else
							{
								//Ré affectation mal déroulée
								$Page=$CheminTpl.'essaim_erreur.tpl';
							}
						}  //Fin de OK supprimé
						else
						{
							//La suppression n'a pas eu lieu
							$Page=$CheminTpl.'erreur_essaim_suppression.tpl';
						}
						
						
					}
						
					break;
			case 3 :  //On supprime simplement l'essaim		
					$AncienEssaim=$_SESSION['ID_Essaim'];
					//Récupère l'ID de l'ancien essaim
					$SQLS="SELECT ID_RUCHE FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
					foreach($DBConn->query($SQLS) as $row)
					{
				        $ID_RucheMod=$row['ID_RUCHE'];  
					}
					$SQLS="DELETE FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
					//Exécution de la requete
					$query=$DBConn->prepare($SQLS);
	                $query->execute();
					//Controle de la suppression
					$SQLS="SELECT count(*) as Compte FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
					foreach($DBConn->query($SQLS) as $row)
					{
						$Compte=$row['Compte'];
					}
					if ($Compte==0)
					{
						//OK
						$Page=$CheminTpl.'essaim_supprime.tpl';
						//On modifie la ruche en conséquence
						$SQLS="UPDATE ruche SET ID_ETAT=$RucheMorte WHERE ID_Ruche=$ID_RucheMod";
						$query=$DBConn->prepare($SQLS);
			            //On modifie base
	                    $query->execute();
					}
					else
					{
						$Page=$CheminTpl.'erreur_essaim_suppression.tpl';
					}
					
					break;
			default :
					$Page=$CheminTpl.'erreur_rucher.tpl';
			
		} //fin switch action
		
		//On parse la page
		$template->display($Page);
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