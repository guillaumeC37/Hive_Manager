<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	mdp_oubli.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Page permettant de récupérer le mot de passe						 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
require("include/smarty.class.php");
include "include/config.inc.php";
include "include/function.inc.php";
$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
$template=new Smarty();
$CheminTpl='../templates/';
if (isset($_POST['demande']))
{
/*Pour debug
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
		$Erreur=0;
		if (isset($_POST['login']))
		{
			$LeLogin=htmlspecialchars($_POST['login'], ENT_NOQUOTES, "UTF-8");
		}
		else
			$Erreur=1;
		if (isset($_POST['reponse']))
		{
			$LaReponse=htmlspecialchars($_POST['reponse'], ENT_NOQUOTES, "UTF-8");
		}
		else
			$Erreur=1;
		$LaQuestion=(int)$_POST['question'];
		if($Erreur==0)
		{
			$SQLS="SELECT ID_Question, Re_Question FROM apiculteur WHERE login='$LeLogin'";
			foreach($DBConn->query($SQLS) as $row)
			{
				$IDQ_Base=$row['ID_Question'];
				$Rep_Base=$row['Re_Question'];
			}
			if(!isset($IDQ_Base))
			{
				$IDQ_Base="";
			}
			if(($IDQ_Base==$LaQuestion) &&($Rep_Base==$LaReponse))
			{
				//On récupère l'ID de l'apiculteur
				$SQLS="SELECT ID_Apiculteur FROM apiculteur WHERE Login='$LeLogin'";
				foreach($DBConn->query($SQLS) as $row)
				{
					$ID_Api=$row['ID_Apiculteur'];
				}
				$template->assign('Id_Api',$ID_Api);
				$Page=$CheminTpl.'new_mdp_lost.tpl';
			}
			else
			{
				$Page=$CheminTpl.'erreur_recov_mdp.tpl';
			}
		}//Fin pas d'erreur
		else
		{
			$Page=$CheminTpl.'erreur_recov_mdp.tpl';
		}	
		$template->display($Page);
} //on a recu une demande POST
else
{
	//On récupère la liste de question
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
    $Page=$CheminTpl.'mdp.tpl';
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