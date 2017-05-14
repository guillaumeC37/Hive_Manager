<?php
  session_start();
  require("include/smarty.class.php");
  include "include/config.inc.php";
  include "include/function.inc.php";
  $template=new Smarty(); 
//On verifie si on est dans la session
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];

  }//Fin de if in session
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
	 $DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
     //On vérifie si on a l'ID ruche et autre dans la session et on affiche la page
	if (isset($_SESSION['ID_Ruche'])&&($_SESSION['ID_API']))
	{
		$ID_Ruche=$_SESSION['ID_Ruche'];
		$ID_Api=$_SESSION['ID_API'];
		if(isset($_POST['reaffecte']) or (isset($_POST['creer_essaim'])))  //On a réaffecter l'essaim ou on créé l'essaim
	    {
/* Pour debug
echo "<pre> Session :";
print_r ($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";  
*/	 
		$Choix=0;
		  if(isset($_POST['reaffecte']))
			$Choix=1;
		  else
		  {
		  	  if (isset($_POST['creer_essaim']))
				$Choix=2;
		  }
		  $ErreurPost=0;
		  switch ($Choix)
		  {
			case 1 : 
					  if (isset ($_POST['EssaimE']))
					  {
					    
						$ID_Essaim=(int)$_POST['EssaimE'];
					    $Action=$_POST['reaffecte'];
						$SQLS='';
						if($Action==2)
						{
						  $SQLS="UPDATE essaim SET ID_RUCHE=$ID_Ruche WHERE ID_ESSAIM=$ID_Essaim";
						}
						else
						{
							if ($Action==3)
							{
								$SQLS="DELETE FROM essaim  WHERE ID_ESSAIM=$ID_Essaim";
							}
						}	
						$query=$DBConn->prepare($SQLS);
			            //On modifie la base
	                    if($query->execute())
						{
							$Page='../templates/essaim_modifie.tpl';
						}
						else
						{
							$ErreurPost=1;
						}
					  }
					  else
					  {
						 $ErreurPost=1;
						 //erreur on ne fait rien 
					  }
					  break;
			case 2 : 
					  //On récupère les informations
					  if(isset($_POST['Nom_Essaim']))
					  {
						$NomEssaim=$_POST['Nom_Essaim'];
						//On vérifie que le couple Nom Essaim+ID Api n'existe pas dans la base
						$SQLS="SELECT count(*) as Nombre FROM essaim WHERE Nom_ESSAIM='$NomEssaim' AND Id_apiculteur=$ID_Api";
					    foreach($DBConn->query($SQLS) as $row)
					    {
				            $Compte=$row['Nombre'];  
						}
						if ($Compte>0)
						{
				//L'essaim existe déjà  
							$Page='../templates/essaim_existe.tpl';
						} 
						else  //L'essaim n'existe pas
						{
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
						   }
						   else
							   $Age='';
						   if(isset($_POST['Or_R']))
						   {
							   $Or_reine=htmlspecialchars($_POST['Or_R'],ENT_NOQUOTES,'UTF-8');
						   }
						   else
							   $Or_reine='';
						   if(isset($_POST['OriE']))
						   {
							   $Origine=$_POST['OriE'];
						   }
						   else
							   $ErreurPost=1;
						   if(isset($_POST['IdRuche']))
						   {
							  $EssaimRuche=(int)$_POST['IdRuche'];
						   }
						   else  //Si l'ID Ruche n'est pas affecté, on affecte d'office l'ID courante
							   $EssaimRuche=$ID_Ruche;
						   if($ErreurPost==0)  //Si on a pas eu d'erreur jusqu'ici
						   {
						     $TableInsert=array(':Nom'=>$NomEssaim,':Ruche'=>$EssaimRuche,':Api'=>$ID_Api,':Espece'=>$Espece,':Origine'=>$Origine,':DateE'=>$DateE,':AgeR'=>$Age,':OrR'=>$Or_reine,':Lieu'=>$Lieu);
						     $SQLS="CALL P_Add_Essaim(:Nom,:Ruche,:Api,:Espece,:Origine,:DateE,:AgeR,:OrR,:Lieu)";
						     $query=$DBConn->prepare($SQLS);
			               //On ajoute à la base
	                         $query->execute($TableInsert);
						   //On vérifie l'ajout
						     $SQLS="SELECT count(*) as Nombre FROM essaim WHERE Nom_ESSAIM='$NomEssaim' AND Id_apiculteur=$ID_Api";
					         foreach($DBConn->query($SQLS) as $row)
					         {
				                $Compte=$row['Nombre'];  
						     }
						     if ($Compte==1)
						     {
				                //Ajout OK
							  $Page='../templates/essaim_ajoute.tpl';
						     } 
						     else  //L'essaim n'existe pas
						     {
							     $ErreurPost=1;
						     }
						   }  //Fin if Erreur Post=0
						}
					  //si erreur -> $ErreurPost=1;  
					  
					  }
					  else  //On a pas le nom
					  {
						  $ErreurPost=1;
					  }
				      break;
			default :  
			         $ErreurPost=1;
		  }
		  if($ErreurPost!=0)  //Il y a eu une errreur
		  {
			$Page='../templates/essaim_erreur.tpl';  
		  }
		  $template->display($Page);
        }//Fin requete SQL
	    else
	    {
			//selection du nom de la ruche en court
			$SQLS="SELECT Nom_Ruche FROM ruche WHERE Id_Ruche=$ID_Ruche";
			foreach($DBConn->query($SQLS) as $row)
            {
				$NomRucheAff=$row['Nom_Ruche'];
			}
			$template->assign('Nom_RucheSel',$NomRucheAff);
			 //On selectionne les infos Ruches-Essaim appartenant à l'apiculteur
            $SQLS="SELECT ID_ESSAIM,NOM_ESSAIM, Nom_Ruche FROM vue_essaim_nomruche WHERE Id_Apiculteur=$ID_Api";
			$i=0;
		    $MaTable=array();
            foreach($DBConn->query($SQLS) as $row)
            {
	            $MaTable[$i]['ID_E']=$row['ID_ESSAIM'];
	            $MaTable[$i]['NomE']=$row['NOM_ESSAIM'];
	            $MaTable[$i]['NomR']=$row['Nom_Ruche'];
	            $i++;
            }
			$template->assign('liste_essaims',$MaTable);
			//On vérifie si une ligne existe avec une affectation à cette ruche (doubla affectation=erreur assurée)
			$SQLS="SELECT count(*) as Compte FROM vue_essaim_nomruche WHERE ID_RUCHE=$ID_Ruche";
			foreach($DBConn->query($SQLS) as $row)
            {
				$Compte=$row['Compte'];
			}
			if ($Compte>0)
			{
				//On bloque l'affectation
				$Bloqueur='disabled="disabled"';
			}
			else
			{
				$Bloqueur='';
			}
			$template->assign('Blocage',$Bloqueur);
			 //On selectionne l'origine
            $SQLS="SELECT ID_ORIGINE, NOM_ORIGINE FROM origine_essaim ORDER BY NOM_ORIGINE";
            $i=0;
            $MaTable2=array();
			foreach($DBConn->query($SQLS) as $row)
            {
	           $MaTable2[$i]['Id_O']=$row['ID_ORIGINE'];
	           $MaTable2[$i]['Nom_O']=$row['NOM_ORIGINE'];
	           $i++;
            }
			$template->assign('liste_origines',$MaTable2);
			//On selectionne les ruches n'ayant pas d'essaim lié.
			$SQLS="SELECT Id_Ruche, Nom_Ruche FROM vue_ruche_sans_essaims WHERE Id_Apiculteur=$ID_Api";
            $i=0;
            $MaTable3=array();
            foreach($DBConn->query($SQLS) as $row)
            {
	           $MaTable3[$i]['Id_R']=$row['Id_Ruche'];
	           $MaTable3[$i]['Nom_R']=$row['Nom_Ruche'];
	           if ($ID_Ruche==$row['Id_Ruche'])
	           {
		          $MaTable3[$i]['Sel']='selected'; 
	           }
	           else
		          $MaTable3[$i]['Sel']=''; 
	           $i++;
            }
            $template->assign('liste_ruches',$MaTable3);
			$template->display('../templates/add_essaim.tpl');  
	    }//fin de pas de SQL
	 }//Fin de session complete.  
	 else
	 {
			//On est dans le nomans land
			echo "<p>On est dans le no man's land</p>";
			$Page='../templates/erreur_rucher.tpl';
	 }
	  //On parse la page
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page
  }
?>  