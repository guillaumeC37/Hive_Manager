{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/rucher.css">
<script src="script/rucher.js"></script>
</head>
  <body>
    <h1 id="titre">Inscription d'un apiculteur</h1>
	<form name="add_appi" method="post" action="signIn.php">
	<p>* : champs obligatoires</p>
    <p><label for="nom">Nom* :&nbsp;</label><input name="nom" type="text" class="ChampsForm"></p>
    <p><label for="prenom">Pr&eacute;nom* :&nbsp;</label><input name="prenom" type="text" class="ChampsForm"></p>
	<p><label for="login">Login* :&nbsp;</label><input name="login" type="text" class="ChampsForm"></p>
	<p><label for="pass1">mot de passe* :&nbsp;</label><input name="pass1" type="password" class="ChampsForm"></p>
	<p><label for="pass2">Confirmation* :&nbsp;</label><input name="pass2" type="password" onkeyup="verifPass();" class="ChampsForm"><img src="" id="mdpOK"></p>
    <p><label for="adresse">Adresse* :&nbsp;</label><input name="adresse" type="text" size="4" class="ChampsForm">&nbsp;
      <select name="voie" class="ChampsForm">
        {foreach from=$liste_voies item=infos}
	  <option value="{$infos.Id_Type}">{$infos.Nom_Type}</option>
	  {/foreach}
      </select>
      &nbsp;<input name="nomvoie" type="text" size="50" class="ChampsForm"></p>
    <input name="cp" type="text" size="6" class="ChampsForm">&nbsp;<input name="ville" type="text" size="50" class="ChampsForm">
    <p><label for="siret">Siret :&nbsp;</label><input name="siret" type="text" class="ChampsForm"></p>
    <p><label for="ape">Code APE :&nbsp;</label><input name="ape" type="text" class="ChampsForm"></p>
    <p><label for="numagrit">NUMAGRIT* :&nbsp;</label><input name="numagrit" type="text" class="ChampsForm"></p>
    <p><label for="napi">Code NAPI* :&nbsp;</label><input name="napi" type="text" class="ChampsForm"></p>
    <p><label for="mail">Adresse mail :&nbsp;</label><input name="mail" type="text" class="ChampsForm"></p>
	<p><label for="Listequestion">question secr&egrave;te (pour changer le mot de passe)* : <select name="Listequestion">
	{foreach from=$liste_question item=infos}
	  <option value="{$infos.Id_Q}">{$infos.Nom_Q}</option>
	  {/foreach}
	 </select></p>
	 <p><label for="reponse">R&eacute;ponse &agrave; la question* : </label><input type="text" name="reponse" class="ChampsForm"></p>
	 <p>Attention, il n'y a pas d'autres moyen de r&eacute;cup&eacute;rer votre mot de passe que celui-ci. Conservez le et rappelez vous bien de votre r&eacute;ponse, en cas de souci</p>
	<input type="hidden" name="newApi" value="true">
    <p class="pboutons_formulaires"><input  class="boutons_formulaires" value="Valider" name="Submit" type="button" onclick="SubmitApi();"><input value="Annuler" class="boutons_formulaires" name="cancel" type="reset"></p>
 </form>
 <p><a href="index.php" id="LienRetour">Retour index</a></p>

