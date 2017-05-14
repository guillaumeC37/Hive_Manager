<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 		Page de gestion android										 *
 * Nom de la page :													 *
 * Date création :													 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version :														 *
 * Objet et notes :													 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 session_start();
  include "../include/config.inc.php";
  include "../include/function.inc.php";
//On verifie si on est dans la session
 // On recherche le token dans la BDD avec ID +token en get, et on regarde le timestamp et la validité. Si TS<now, validité=0, et on annule la demande. Il faut se relogger
//Je sais pas si les sessions fonctionneront 
 if(true)
 {	 
/*
echo "<pre>";
echo "<p>POST</p>";
print_r($_POST);
echo "</pre>";
*/
	  //On parse la page
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  http_response_code(401); //Erreur d'authentification
  }
?>  