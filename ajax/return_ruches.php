<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	return_ruches.php								 *
 * Date création :	27/05/2018										 *
 * Date Modification :	27/05/2018									 *
 * Créateur : Guillaume Crégut										 *
 * Version :	0.2A												 *
 * Objet et notes :													 *
 * Retourne en ajax/json les infos carto rucher+ruches 				 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
//Connexion à la base de données pour récupérer les infos
	session_start();
	include "../include/config.inc.php";
	include "../include/function.inc.php";
	if (isset($_SESSION['InSession']))
	{
		$InSession=$_SESSION['InSession'];
	}
	else
		$InSession=false;	
	if ($InSession) //On est dans la session
	{	
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$Id_Rucher=$_SESSION['ID_Rucher'];
		$ID_Api=$_SESSION['ID_API'];
		//Récupération du nom de l'image du rucher
		$SQLS="SELECT Path_Image FROM Rucher WHERE ID_Rucher=".$Id_Rucher;
		foreach($DBConn->query($SQLS) as $row)
		{
			$Image_Rucher=$row['Path_Image'];
		}
		$CheminPhotoRucher="images/carto/$ID_Api/".$Image_Rucher;
		if($Image_Rucher!='')
		{
			$SQLS="SELECT X_Ruche,Y_Ruche,Z_Ruche,Nom_Ruche FROM vue_coord_ruche_rucher WHERE id_Rucher=$Id_Rucher";
			$i=0;
			foreach($DBConn->query($SQLS) as $row)
			{
				$TabRuches[$i]['X_Ruche']=$row['X_Ruche'];
				$TabRuches[$i]['Y_Ruche']=$row['Y_Ruche'];
				$TabRuches[$i]['Z_Ruche']=$row['Z_Ruche'];
				$TabRuches[$i]['LeNom']=$row['Nom_Ruche'];
				$i++;
			}
			$JsonRuches=json_encode(array('Rucher'=>$CheminPhotoRucher,'Ruches'=>$TabRuches));
				echo $JsonRuches;
		}
		else
		{
			//Erreur.
			echo'';
		}
	}
	else
	{
		echo'';
	}
?>