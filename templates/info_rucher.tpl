 {include file="entete_open.html"}
<link rel="stylesheet" href="style/default/infos.css">
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
  <h1 id="titre">Informations rucher</h1>
  <p>Apiculteur : <span class="info_item">{$Nom_prenom}</span></p>
  <p>Nom du rucher : <span class="info_item">{$NomRucher}</span></p>
  <p>Num&eacute;ro de rucher :<span class="info_item">{$NumRucher}</span></p>
  <p>Activit&eacute; :<img src="images/{$Actif}.png"</p></p>
  <p>localisation : <span class="info_item">{$Loc}</span></p>
  <p>Coordonn&eacute;es GPS :<span class="info_item">{$GPS}</span></p>
  <p>Observations :</p>
  <p><span id="Observations">{$Observations}</span></p>
  <p id="modif_btn"><a href="modif_rucher.php">Modifier</a></p>
  <p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
	