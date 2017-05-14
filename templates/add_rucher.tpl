{include file="entete_open.html"}
<script src="script/rucher.js"></script>
<link rel="stylesheet" href="style/default/rucher.css">
</head>
  <body>
    <h1 id="titre">Ajouter un rucher</h1>
	<p>* : champs obligatoires</p>
	<form name="add_rucher" action="ajoutrucher.php" method="post">
    <p><input value="1" name="rucheractif" type="checkbox" checked>Rucher actif</p>
    <p><label for="nomRucher">Nom du rucher* :&nbsp;</label><input name="nomRucher" type="text" class="ChampsForm"></p>
    <p><label for="localisation">localisation* :&nbsp;</label><input name="localisation" type="text" class="ChampsForm"></p>
    <p><label for="coordonnees">Coordonnées GPS :&nbsp;</label><input name="coordonnees" type="text" class="ChampsForm"></p>
    <p><label for="Obs">Observations :&nbsp;</label><textarea name="Obs" class="ChampsForm"></textarea></p>
    <p><label for="numero">Numéro de rucher* :&nbsp;</label><input name="numero" type="text" class="ChampsForm"></p>
    <p class="pboutons_formulaires"><input  class="boutons_formulaires" value="Valider" name="Submit" type="button" onclick="SubmitRucher();"><input value="Annuler"class="boutons_formulaires" name="cancel" type="reset"></p>
	<input type="hidden" name="AjoutRucher" value="1">
	</form>
	<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p>
