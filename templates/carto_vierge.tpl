 {include file="entete_carto_rucher.html"}
 <link rel="stylesheet" href="style/default/rucher_rucher.css">
 <link rel="stylesheet" href="style/default/rucher.css">
 <link rel="stylesheet" href="style/default/carto.css">
  </head>
<body>
    <header>
		<h1 id="titre"> Gestion du rucher - Cartographie</h1>
	</header>
	<section id="LaSection">
	<article id="Larticle">
		{if isset($Resultat)}
		<p><strong>{$Resultat}</strong></p>
		{/if}
		<p>Nom : {$NomRucher}</p>
		<p>Num&eacute;ro : {$NumRucher}</p>
		{if isset($NomPhoto)}
		<p>Photo actuelle</p>
		<p><img src="{$NomPhoto}" alt="photo du rucher"></p>
		{/if}
		<form name="Add_photo" method="post" action="" enctype="multipart/form-data">
			<fieldset>
				<legend>Ajouter une photo du rucher.</legend>
				<p><label for="chem_fiche">Chemin de la photo : </label><input type="file" id="chem_fiche" name="chem_fiche"></p>
				<p><label for="nom_fiche">Nom du fichier (sans extension) : </label><input type="text" id="nom_fiche" name="nom_fiche"></p>
				<p><input type="submit" name="valider" value="valider"></p>
			</fieldset>
		</form>
	</article>
	<aside id="Laside">
		<p><a href="voir_carto_rucher.php" id="LienCarto">Voir la cartographie du rucher</a></p>
	</aside>
	</section>
 <p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>