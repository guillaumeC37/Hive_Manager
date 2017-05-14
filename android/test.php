<?php
 $Prenom="?";
 $Nom="?";
 if (isset($_POST["login"]))
 {
	 $Prenom=$_POST["login"];
 }
 if (isset($_POST["lastname"]))
 {
	 $Nom=$_POST["lastname"];
 }
 echo "Bonjour $Prenom $Nom";
?>