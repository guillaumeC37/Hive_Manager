{include file="entete_carto_rucher.html"}
	<link rel="stylesheet" href="style/default/rucher_rucher.css">
	<link rel="stylesheet" href="style/default/rucher.css">
	<link rel="stylesheet" href="style/default/carto.css">
	<script  src="script/classes/ruche.js"></script>
	<script  src="script/classes/rucher.js"></script>
	<script  src="script/loader_rucher.js"></script>
</head>
<body>
   <header>
		<h1 id="titre"> Gestion du rucher - Cartographie</h1>
	</header>
	<section>
	<canvas id="canvas">Votre navigateur ne supporte pas le canvas</canvas>
	<form name="monform" id="monform" method="post" action="save_carto.php">
		<p><input type="button" name="Btn_Save" id="Btn_Save" value="Sauvegarder" onclick="Sauvegarde()"></p>
		<input type="hidden" name="Image_Ruche" value="" id="Image_Ruche">
	</form>
	<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
	</section>