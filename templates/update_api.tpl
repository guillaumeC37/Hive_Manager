{include file="entete_open.html"}
<script src="script/Change_api.js"></script>
<script src="script/rucher.js"></script>
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
    <h1 id="titre">Inscription d'un apiculteur</h1>
    <form name="add_appi" method="post" action="update_api.php">
      <p>* : champs obligatoires</p>
      <p>Nom : {$NomApi}</p>
	  <p>Pr&eacute;nom : {$PrenomApi}</p>
	  <p>Login : {$Login}</p>
	  <p>Laissez vide les mots de passe si vous ne souhaitez pas le changer</p>
	  <p><label for="pass1">mot de passe :&nbsp;</label><input name="pass1" class="ChampsForm" type="password" onchange="changevalue(this)">
      <p><label for="pass2">Confirmation :&nbsp;</label><input name="pass2" onkeyup="verifPass();" class="ChampsForm" type="password"><img src="" id="mdpOK"></p>
      <p><label for="adresse">Adresse* :&nbsp;</label><input name="adresse" size="4" class="ChampsForm" type="text" value="{$NumRue}" onchange="changevalue(this)">&nbsp;
        <select name="voie" class="ChampsForm" onchange="changevalue(this)">
          {foreach from=$liste_voies item=infos}
          <option value="{$infos.Id_Type}" {$infos.selection}>{$infos.Nom_Type}</option>
          {/foreach}
        </select>&nbsp;<input name="nomvoie" size="50" class="ChampsForm" type="text" value="{$NomRue}" onchange="changevalue(this)"></p>
      <p><input name="cp" size="6" class="ChampsForm" type="text" value="{$CP}" onchange="changevalue(this)">&nbsp;<input name="ville" size="50" class="ChampsForm" type="text" value="{$NomVille}" onchange="changevalue(this)"></p>
      <p><label for="siret">Siret :&nbsp;</label><input name="siret" class="ChampsForm" type="text" value="{$SIRET}" onchange="changevalue(this)"></p>
      <p><label for="ape">Code APE :&nbsp;</label><input name="ape" class="ChampsForm" type="text" value="{$APE}" onchange="changevalue(this)"></p>
      <label for="mail">Adresse mail :&nbsp;</label><input name="mail" class="ChampsForm" type="text" value="{$Ad_Mail}" onchange="changevalue(this)">
      <p>Veuillez de nouveau saisir :</p>
	  <p><label for="Listequestion">question secr&egrave;te (pour changer le mot de passe)* :</label>  <select name="Listequestion" class="ChampsForm" >
            {foreach from=$liste_question item=infos}
            <option value="{$infos.Id_Q}">{$infos.Nom_Q}</option>
            {/foreach}
          </select> </p>
      <p><label for="reponse">R&eacute;ponse &agrave; la question* : </label><input name="reponse" type="text" class="ChampsForm"></p>
      <p>Attention, il n'y a pas d'autres moyen de r&eacute;cup&eacute;rer votre mot de passe que celui-ci. Conservez le et rappelez vous bien de votre r&eacute;ponse, en cas de souci</p>
      <input name="ChangeApi" value="true" type="hidden">
      <p class="pboutons_formulaires"><input class="boutons_formulaires" value="Valider" name="Submit" onclick="Submitchange();" type="button"><input value="Annuler" class="boutons_formulaires" name="cancel" type="reset"></p>
    </form>
    <p><a href="index.php" id="LienRetour">Retour index</a></p>
