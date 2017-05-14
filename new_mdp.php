<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	new_mdp.php										 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Créer un nouveau mot de passe									 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
require("include/smarty.class.php");
include "include/config.inc.php";
include "include/function.inc.php";
$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
$template=new Smarty();
$CheminTpl='../templates/';
/*Pour debug
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/
if (isset($_POST['newMDP']))
{
	$Erreur=0;
	if (isset($_POST['Id_Api']))
	{
		$Id_Api=(int)$_POST['Id_Api'];
	}
	else 
		$Erreur=1;
	if (isset($_POST['pass1']))
	{
		$Pass1=htmlspecialchars($_POST['pass1'], ENT_NOQUOTES, "UTF-8");
	}
	else 
		$Erreur=1;
	if (isset($_POST['pass2']))
	{
		$Pass2=htmlspecialchars($_POST['pass2'], ENT_NOQUOTES, "UTF-8");
	}
	else 
		$Erreur=1;
	if ($Pass1=='')
	{
		$Erreur=1;
	}
	if($Erreur==0)
	{
		//On a tout recu du formulaire
		if($Pass1==$Pass2)
		{
			//On crypte le mot de passe
			//$Password=md5($Pass1);
			$Password= hash('sha512',($SelHash.$Pass1));
			$TableValeur=array(':Id_Api'=>$Id_Api,':MDP'=>$Password);
			//On appelle la procédure stockée
			$SQLS="CALL P_Update_Api_Pass(:Id_Api,:MDP)";
			$query=$DBConn->prepare($SQLS);
			$query->execute($TableValeur);
			$count=$query->rowCount();
			if($count==1)
			{
				$Page=$CheminTpl.'mdp_ok.tpl';
			}
			else
			{
				$Page=$CheminTpl.'erreur_recov_mdp.tpl';
			}
		}//Fin MDP egaux
		else
		{
			$Page=$CheminTpl.'erreur_recov_mdp.tpl';
		}
	}
	else
	{
		//erreurs dans les données du formulaire
		$Page=$CheminTpl.'erreur_recov_mdp.tpl';
	}
}//On demande un nouveau mot de passe
else
{
	$Page=$CheminTpl.'retour_index.tpl';
	
}
$template->display($Page);
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