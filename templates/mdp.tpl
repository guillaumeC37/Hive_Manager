{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body> 
<form name="demande" action="mdp_oubli.php" method="post">
<input type="hidden" name="demande" value="1">
<p><label for="login">Login : </label><input type="text" name="login"></p>
<p>Question : <select name="question">
      {foreach from=$liste_question item=infos}
	  <option value="{$infos.Id_Q}">{$infos.Nom_Q}</option>
	  {/foreach}
</select></p>
<p><label for="reponse">R&eacute;ponse &agrave; la question : </label><input type="text" name="reponse"></p>
<p>Attention, il n'y a pas d'autres moyen de r&eacute;cup&eacute;rer votre mot de passe que celui-ci.</p>
<p><input type="submit" value="Valider"></p>
</form>
<p><a href="index.php" id="LienRetour">retour &agrave; l'index</a></p>
