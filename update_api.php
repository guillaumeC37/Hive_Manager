<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	update_api.php									 *
 * Date création :													 *
 * Date Modification :	08/03/2017									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Mets à jour les informations de l'apiculteur						 *
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
	if(isset($_POST['ChangeApi']))
	{
/* Pour debug
echo "<pre>Session :";
print_r($_SESSION);
echo "</pre>";
echo "<pre>POST :";
print_r($_POST);
echo "</pre>";
*/	
		if (isset($_SESSION['ID_API']))
		{
			$Erreur=0;
			$TemplateUser=$_SESSION['Template_User'];
			$template->assign('TemplateUser',$TemplateUser);
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			$Id_Api=$_SESSION['ID_API'];
			$Pass=false;
			if(isset($_POST['adresse']))
			{
				$NumAdresse=(int)$_POST['adresse'];
				if(filter_var($NumAdresse, FILTER_VALIDATE_INT) === false)
					$Erreur=1;
			}
			else
				$Erreur=1;
			if(isset($_POST['voie']))
			{
				$TypeVoie=$_POST['voie'];
				if(filter_var($TypeVoie, FILTER_VALIDATE_INT) === false)
					$Erreur=1;
			}
			else
				$Erreur=1;
			if(isset($_POST['nomvoie']))
			{
				$NomVoie=htmlspecialchars($_POST['nomvoie'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Erreur=1;
			if(isset($_POST['cp']))
			{
				$CP=(int)$_POST['cp'];
				 if(filter_var( $CP, FILTER_VALIDATE_INT) === false)
					 $Erreur=1;
			}
			else
				$Erreur=1;
			if(isset($_POST['ville']))
			{
				$NomVille=htmlspecialchars($_POST['ville'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Erreur=1;
			if(isset($_POST['siret']))
			{
				$Siret=htmlspecialchars($_POST['siret'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Siret='';
			if(isset($_POST['ape']))
			{
				$APE=htmlspecialchars($_POST['ape'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$APE='';
			if(isset($_POST['mail']))
			{
				$Mail=htmlspecialchars($_POST['mail'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Mail='';
			if(isset($_POST['Listequestion']))
			{
				$ListeQ=$_POST['Listequestion'];
				if(filter_var( $ListeQ, FILTER_VALIDATE_INT) === false)
					$Erreur=1;
			}
			else
				$Erreur=1;
			if(isset($_POST['reponse']))
			{
				$Reponse=htmlspecialchars($_POST['reponse'],ENT_NOQUOTES,'UTF-8');
			}
			else
				$Erreur=1;
			if(isset($_POST['pass1']))
			{
				$Pass1=htmlspecialchars($_POST['pass1'],ENT_NOQUOTES,'UTF-8');
				$Pass2=htmlspecialchars($_POST['pass2'],ENT_NOQUOTES,'UTF-8');
				if($Pass1==$Pass2)
				{
					//$MotPasse=md5($Pass1); Non recommandé.
					$MotPasse= hash('sha512',($SelHash.$Pass1));
					$Pass=true;
				}
			}
			if ($Erreur==0)
			{
				if($Pass)
				{
					//SQL avec mot de passe
					$MaTable=array(':MotPasse'=>$MotPasse,':APE'=>$APE,':sire'=>$Siret,':AdMail'=>$Mail,':LaVille'=>$NomVille,':NumRue'=>$NumAdresse,':NomRue'=>$NomVoie,':CP'=>$CP,':TypeVoie'=>$TypeVoie,':ID_Q'=>$ListeQ,':Reponse'=>$Reponse,':IDAPI'=>$Id_Api);
					$SQLS="CALL P_Update_Api_Full(:MotPasse,:APE,:sire,:AdMail,:LaVille,:NumRue,:NomRue,:CP,:TypeVoie,:ID_Q,:Reponse,:IDAPI)";
				}  
				else
				{
					//SQLS sans mot de passe
					$MaTable=array(':APE'=>$APE,':sire'=>$Siret,':AdMail'=>$Mail,':LaVille'=>$NomVille,':NumRue'=>$NumAdresse,':NomRue'=>$NomVoie,':CP'=>$CP,':TypeVoie'=>$TypeVoie,':ID_Q'=>$ListeQ,':Reponse'=>$Reponse,':IDAPI'=>$Id_Api);
					$SQLS="CALL P_Update_Api(:APE,:sire,:AdMail,:LaVille,:NumRue,:NomRue,:CP,:TypeVoie,:ID_Q,:Reponse,:IDAPI)";
				}
				$query=$DBConn->prepare($SQLS);
				$query->execute($MaTable); 
				//Compte le nombre de lignes modifiées
				$count=$query->rowCount();
				if($count==1)
				{
					$Page=$CheminTpl.'modif_api_ok.tpl';
				}
				else
				{
					$Page=$CheminTpl.'modif_api_fail.tpl';  //pas OK
				}				
			}
			else
			{
				//erreur dans la formulaire
				$Page=$CheminTpl.'erreur_rucher.tpl';
			}
		}//Fin Api ID isset
	else
	{
		//No man's land
		$Page=$CheminTpl.'erreur_rucher.tpl';
	}
  }//on a recu le formulaire en demande
	else
	{
		if (isset($_SESSION['ID_API']))
		{
			$Id_Api=$_SESSION['ID_API'];
			$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
			//Récupère les infos de l'apiculteur
			$SQLS="SELECT Login, Code_APE,SIRET, Nom_Api,Prenom_Api,Ad_Mail,Ville,Num_Rue,Nom_Rue,Code_Postal,Id_Type FROM apiculteur WHERE ID_Apiculteur=$Id_Api";
			foreach($DBConn->query($SQLS) as $row)
			{
				$Login=$row['Login'];
				$Code_APE=$row['Code_APE'];
				$SIRET=$row['SIRET'];
				$Nom_Api=$row['Nom_Api'];
				$Prenom_Api=$row['Prenom_Api'];
				$Ad_Mail=$row['Ad_Mail'];
				$Ville=$row['Ville'];
				$Num_Rue=$row['Num_Rue'];
				$Nom_Rue=$row['Nom_Rue'];
				$Code_Postal=$row['Code_Postal'];
				$Id_Rue=$row['Id_Type'];					
			}
			$template->assign('NomApi',$Nom_Api);
			$template->assign('PrenomApi',$Prenom_Api);
			$template->assign('Login',$Login);
			$template->assign('NumRue',$Num_Rue);
			$template->assign('NomRue',$Nom_Rue);
			$template->assign('CP',$Code_Postal);
			$template->assign('NomVille',$Ville);
			$template->assign('Ad_Mail',$Ad_Mail);
			$template->assign('SIRET',$SIRET);
			$template->assign('APE',$Code_APE);
			//récupération de la liste des types de rue
			$SQLS="select Id_Type, Nom_Type FROM type_voie ORDER BY Nom_Type"; 
			$i=0;
			$ListeVoies=array();
			foreach($DBConn->query($SQLS) as $row)
			{
				$ListeVoies[$i]['Id_Type']=$row['Id_Type'];
				$ListeVoies[$i]['Nom_Type']=$row['Nom_Type'];
				if ($row['Id_Type']==$Id_Rue)
				{
					$ListeVoies[$i]['selection']='selected';
				}
				else
					$ListeVoies[$i]['selection']='';
				$i++;
			}
			$template->assign('liste_voies',$ListeVoies);
			//récupère la liste de question
			 $SQLS="SELECT ID_Question, Nom_Question FROM question_secrete ORDER BY Nom_Question";
			 $i=0;
			 $ListeQuestion=array();
			 foreach($DBConn->query($SQLS) as $row)
			 {	  
				$ListeQuestion[$i]['Id_Q']=$row['ID_Question'];
				$ListeQuestion[$i]['Nom_Q']=$row['Nom_Question'];
				$i++;
			 }
			 $template->assign('liste_question',$ListeQuestion);
			 $Page=$CheminTpl.'update_api.tpl';
		}
		else
		{
			//No man's land
			$Page=$CheminTpl.'erreur_rucher.tpl';
		}
		
		//On parse sans les requetes
	}
	$template->display($Page);
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