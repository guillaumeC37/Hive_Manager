{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
<h1 id="titre">Essaim de la ruche</h1>
	<p>Ruche : <span class="info_item">{$NomRuche}</span></p>
	<p>Nom de l'essaim : <span class="info_item">{$NomEssaim}</span></p>
	<div id="infoEssaim">
	<p>Esp&egrave;ce : <span class="info_item">{$Espece}</span></p>
    <p>Date de mise en ruche : <span class="info_item">{$DateMR}</span></p>
    <p>Lieu de Capture : <span class="info_item">{$Lieu}</span></p>
    <p>Age de la reine : <span class="info_item">{$AgeR}</span></p>
    <p>Origine de la reine : <span class="info_item">{$OrigR}</span></p>
    <p>Origine de l'essaim : <span class="info_item">{$OrigE}</span></p>
	<form name="" method="post" action="affecte_essaim.php">
	<input type="hidden" name="reaffecte" value="2">
	</form>
	<p><a href="supp_essaim.php">Supprimer ou affecter un autre essaim</a></p>
	<p><a href="voir_ruche.php" id="LienRetour">retour &agrave; la ruche</a></p>
	</div>
