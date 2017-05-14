<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 																	 *
 * Nom de la page :	Génère QR Code.php								 *
 * Date création :	25/02/2017										 *
 * Date Modification :												 *
 * Créateur : Guillaume Crégut										 *													
 * Version :	0.2A												 *
 * Objet et notes :	Génère le QR Code de la ruche sélectionnée		 *
 *																	 *
 *																	 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
 session_start();
  header("Content-type: image/png");
  include "include/config.inc.php";
  include "include/function.inc.php";
  include "include/phpqrcode/qrlib.php";
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
	if(isset($_SESSION['ID_Ruche']))
	{
		putenv('GDFONTPATH=' . realpath('.'));  //Pour récupérer les font. Utile ?
		$ID_Ruche=$_SESSION['ID_Ruche'];
		$SQLS="SELECT R.Nom_Ruche, R.NUM_RUCHE, R.QRCode, Ru.Num_Rucher,Ru.Nom_Rucher FROM ruche R INNER JOIN rucher Ru ON R.id_Rucher=Ru.id_Rucher  WHERE R.ID_Ruche=$ID_Ruche";
		$DBConn=connectbase($userdb,$passdb,$servdb,$nomdb);
		$Racine='documents/'.$_SESSION['ID_API']."/temp/";
		foreach($DBConn->query($SQLS) as $row)
		{
			$NomRuche=$row['Nom_Ruche'];
			$NumRuche=$row['NUM_RUCHE'];
			$QRCode=$row['QRCode'];
			$NomRucher=$row['Nom_Rucher'];
			$NumRucher=$row['Num_Rucher'];
		}
		if($QRCode!='')
		{
			//Génération du QRCode
			$CheminQR=$Racine."$QRCode.png";
			QRcode::png($QRCode,$CheminQR,"H",10,2);
		}
		else
		{
			//comme le QR Code n'existe pas, on ne peut le créer.
			$CheminQR=$Racine.'cvwcvwdfgfgdgsdfg.png';//nom de fichier inexistant
		}
		//Création de l'image à imprimer :
		$font='include/arial.ttf';
		if (file_exists($CheminQR))
		{
			$taille=getimagesize($CheminQR);
			$QR_Size=$taille[0];
			$QRImg=imagecreatefrompng($CheminQR);
		}
		else
		{  //Création d'une image fantome pour utilisation dans le reste.
			$QR_Size=410;
			$QRImg=imagecreatetruecolor($QR_Size,$QR_Size);
			$blanc=imagecolorallocate($QRImg,255,255,255);
			$Noir=imagecolorallocate($QRImg,0,0,0);
			imagefill($QRImg,0,0,$blanc);
			imagettftext($QRImg,72,0,40,133,$Noir,$font,'NO QR');
			imagettftext($QRImg,72,0,60,215,$Noir,$font,'CODE');
		}
		$MargeH=20;
		$MargeW=20;
		$largeur=$QR_Size+$MargeW;
		$TailleFont=10;
		$Box= imagettfbbox($TailleFont, 0, $font,'teste');
		$TailleTexte=$Box[1]-$Box[7];
		$hauteur=$QR_Size+3.5*$MargeH+4*$TailleTexte;
		$image=imagecreatetruecolor($largeur,$hauteur);
		$NewY=0;
		$blanc=imagecolorallocate($image,255,255,255);
		$Noir=imagecolorallocate($image,0,0,0);
		imagefill($image,0,0,$blanc);
		//copie du QRCode dans l'image
		imagecopy($image,$QRImg,($MargeH/2),($MargeW/2),0,0,$QR_Size,$QR_Size);
		//inscription des informations
		$NewY=($MargeH)+$QR_Size;
		imageline($image,0,$NewY,$largeur,$NewY,$Noir);
		$NewY+=$MargeH/2+$TailleTexte;
		imagettftext($image,$TailleFont,0,$MargeW,$NewY,$Noir,$font,'nom de la ruche : '.$NomRuche);
		$NewY+=$MargeH/2+$TailleTexte;
		imagettftext($image,$TailleFont,0,$MargeW,$NewY,$Noir,$font,'numero de la ruche : '.$NumRuche);
		$NewY+=$MargeH/2+$TailleTexte;
		imagettftext($image,$TailleFont,0,$MargeW,$NewY,$Noir,$font,'Nom du rucher : '.$NomRucher);
		$NewY+=$MargeH/2+$TailleTexte;
		imagettftext($image,$TailleFont,0,$MargeW,$NewY,$Noir,$font,'Numéro de rucher : '.$NumRucher);
		imagepng($image);
		
		//Destroy des images
		imagedestroy($QRImg);
		imagedestroy($image);
	}
	else
	{
		//No man's land	
		require("include/smarty.class.php");
		$template=new Smarty(); 
		$Page=$CheminTpl.'erreur_rucher.tpl';
		$template->display($Page);
	}
	  //On parse la page
  }//Fin de on est dans la session
  else
  {
	  //On est pas dans la session
	  //On parse la page
	  require("include/smarty.class.php");
	  $template=new Smarty(); 
	  $Page=$CheminTpl.'erreur.tpl';
	  $template->display($Page);
  }
?>  