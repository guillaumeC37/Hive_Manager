{include file="entete_open.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
<link rel="stylesheet" href="style/{$TemplateUser}/apparence.css">
<script src="script/gest_apparence.js"></script>
  </head>
<body>
<h1 id="titre">Gestion de l'apparence</h1>
<form name="styleApp" method="post" action="">
<p>Apparence actuelle : {$Nom_app}</p>
<p><label for="">Listes des apparences : </label><select name="template" onchange="changeTemplate(this)">
{foreach from=$liste_app item=infos}
<option value="{$infos.Id_App}">{$infos.Nom_App}</option>
{/foreach}
</select></p>
<p>Apparence :</p>
<p><img src="" id="imgfond"></p>
<input type="hidden" value="1" name="changeFond">
<p><input type="submit" value="Valider"></p>
</form>
<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p>