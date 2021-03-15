<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	ajax_ruche_etat.php								 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Renvoie à la page stat apiculteur l'état de la ruche				 *
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
			if(isset($_POST['Id_Ruche']))
			{
				$ID_Ruche=(int) $_POST['Id_Ruche'];
				$Liste_Ruche=array(); //On prépare un tableau a envoyer en json
				$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb); //Connexion à la base de données
				$SQLS="select Nom_ETAT,Nom_Essaim,NBRE_HAUSSE FROM vue_ruche_etat_essaim WHERE ID_Ruche=$ID_Ruche"; 
				foreach($DBConn->query($SQLS) as $row)
				{
					array_push($Liste_Ruche,array("Nom"=>$row['Nom_Essaim'],
											"Etat"=>$row['Nom_ETAT'],
											"NbreHausse"=>$row['NBRE_HAUSSE']));
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