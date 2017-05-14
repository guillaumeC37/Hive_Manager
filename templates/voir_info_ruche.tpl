{include file="entete_open.html"}  
<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/infor.css">
<link rel="stylesheet" href="style/default/infos.css">
<script src="script/voirruche.js"></script>
</head>
<body>
    <h1 id="titre">Informations sur la ruche</h1>
    <p>Rucher&nbsp; : <span class="info_item">{$NomRucher}</span></p>
    <p>Nom de la ruche : <span class="info_item">{$NomRuche}</span></p>
	<div id="infoR">
    <p>Date de cr&eacute;ation : <span class="info_item">{$DateCreation}</span></p>
    <p>Num&eacute;ro de la ruche :<span class="info_item">{$NumRuche}</span></p>
    <p>Type de ruche : <span class="info_item">{$TypeRuche}</span></p>
    <p>Nombe de cadres : <span class="info_item">{$NbreCadre}</span></p>
    <p>Etat : <span class="info_item">{$Etat}</span></p>
    <p>Type de hausse : <span class="info_item">{$TypeHausses}</span></p>
    <p>Nombre de hausses : <span class="info_item">{$NbreHausses}</span></p>
    <p>Observations :</p>
    <p><span id="Observations">{$Observations}</span></p>
	</div>
	<p><a href="genereQR.php" target="_blank" id="QRCode">G&eacute;n&eacute;rer le QR Code de la ruche</a></p>
	<p id="modif_btnr"><a href="modif_ruche.php">Modifier</a></p>
  <p id="back_btn"><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
