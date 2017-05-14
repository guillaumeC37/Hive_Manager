<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	ajax_ruche.php									 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Renvoie à la page stat apiculteur la liste de ruche				 *
 *	En fonction du choix effectué									 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
  session_start();
  include "../include/config.inc.php";
  include "../include/function.inc.php";
//On verifie si on est dans la session
  if (isset($_SESSION['InSession']))
  {
     $InSession=$_SESSION['InSession'];
  }
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
		//On génère un json
		if (isset($_SESSION['ID_API']))
		{
			$ID_API=$_SESSION['ID_API'];
/*
echo "<pre>";
print_r($_SESSION);
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
			if(isset($_POST['Id_Rucher']))
			{
				$ID_Rucher=(int) $_POST['Id_Rucher'];
				$Liste_Ruche=array(); //On prépare un tableau a envoyer en json
				$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb); //Connexion à la base de données
				$SQLS="SELECT ID_Ruche,Nom_Ruche FROM ruche WHERE ID_Rucher=$ID_Rucher ORDER BY Nom_Ruche"; 
				foreach($DBConn->query($SQLS) as $row)
				{
					array_push($Liste_Ruche,array("nom"=>$row['Nom_Ruche'],
											"id"=>$row['ID_Ruche']));
				}
				echo(json_encode($Liste_Ruche));
			}
		}
		else
		{
			//No man's land
		}

  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page

  }
?>  