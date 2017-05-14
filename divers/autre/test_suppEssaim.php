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
  }
  else
    $InSession=false;	
  if ($InSession) //On est dans la session
  {
// Pour debug
echo "<pre> Session :";
print_r ($_SESSION);
print_r ($_POST);
echo "</pre>";  
//	
      $Action=$_POST['reaffecte'];
	  switch($Action)
	  {
		case 2 :  //Supprime et réaffecte
		  	$NouveauEssaim=$_POST['EssaimE'];
			$AncienEssaim=$_SESSION['ID_Essaim'];
			$IdRuche=$_SESSION['ID_Ruche'];
			$SQLS="DELETE FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
			//execute la suppression
			echo "<p>$SQLS</p>";
			//Re affecte l'essaim à la ruche
			$SQLS="UPDATE essaim SET ID_RUCHE=$IdRuche WHERE ID_ESSAIM=$NouveauEssaim";
			echo "<p>$SQLS</p>";			
			break;
		case 3 :  //Supprime
			$AncienEssaim=$_SESSION['ID_Essaim'];
			$SQLS="DELETE FROM essaim WHERE ID_ESSAIM=$AncienEssaim";
			//execute la suppression
			echo "<p>$SQLS</p>";
			break;		
		  
	  }
	  //On parse la page
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page
	  $Page='../templates/erreur.tpl';
	  $template->display($Page);
  }
?>  