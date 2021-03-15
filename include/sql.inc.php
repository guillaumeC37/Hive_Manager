<?php
/* * * * * * * * * * * * * * * * * * * * * 
 *										 *
 *      Liste des requetes SQL utilisées *
 *										 *
 * * * * * * * * * * * * * * * * * * * * */
 $SQL_Nbre_Ruche_Rucher_Api="SELECT Rucher.Nom_Rucher,count(ruche.id_ruche) as NbreRuche FROM rucher Left JOIN ruche On ruche.id_rucher=rucher.id_rucher WHERE rucher.ID_Apiculteur=$ID_API GROUP BY rucher.id_rucher"; 
?>