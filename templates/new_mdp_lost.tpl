{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/rucher.css">
</head>
  <body>
    <h1 id="titre">Formulaire de modification de mot de passe</h1>
	<form name="add_appi" method="post" action="new_mdp.php">
	<input type="hidden" name="newMDP" value="1">
	<input type="hidden" name="Id_Api" value="{$Id_Api}">
    <p><label for="pass1">Nouveau mot de passe :</label><input type="password" name="pass1" class="ChampsForm"></p>
    <p><label for="pass2">V&eacute;rification :</label><input type="password" name="pass2" class="ChampsForm" onkeyup="verifPass();"><img src="" id="mdpOK"></p>
<p><input type="submit" value="Valider"></p>
</form>
<p><a href="index.php" id="LienRetour">retour &agrave; l'index</a></p>
