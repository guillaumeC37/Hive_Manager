{include file="entete_carto_rucher.html"}
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
   <header>
		<h1 id="titre"> Gestion du rucher - Cartographie</h1>
	</header>
	<section>
		{if isset($Nom_Fichier)}
		<p><a href={$Nom_Fichier}><img src={$Nom_Fichier} alt=""></a><br>Cliquez sur l'image pour la t&eacute;l&eacute;charger</p>
		{/if}
		{if isset($Erreur)}
		<p>{$Erreur}</p>
		{/if}
		<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
	</section>