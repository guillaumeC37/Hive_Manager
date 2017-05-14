{include file="enteted.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
<link rel="stylesheet" href="style/{$TemplateUser}/achat.css">
<script src="script/achat.js"></script>
  </head>
<body>
<h1 id="titre">Gestion des achats</h1>
<div id="ajoutachat">
<p id="important">Nouvel achat</p>
<p>* Champ obligatoire</p>
<form name="add_achat" method="post" action="">
<input type="hidden" name="Nouvel_Achat" value="1">
<p><label for="">Magasin* : </label><input name="Magasin" type="text"></p>
<p><label for="">Montant de l'achat* : </label><input name="Montant" type="text" size="5"> euros</p>
<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
<p><label for="">Date de l'achat* : </label><input name="DateAchat" type="text" size="10" onclick="ds_sh(this);"></p>
<p><label for="">Description* : </label><textarea name="Desc"></textarea></p>
<p><input value="valider" name="bouton" type="button" onclick="ValideForm()"></p>
</form>
</div>
<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p>
<hr>
<p id="enteteliste">Listes des achats effectu&eacute;s</p>
<div class="liste_achat">
{foreach from=$Liste_Achats  item=infos}
<p onclick="VoirAchat('achat{$infos.index}')" class="Tete">- Date de l'achat : {$infos.DateAchat} </p>
<div class="UnAchat" id="achat{$infos.index}">
<p>Magasin : {$infos.Magasin}</p>
<p>Montant : {$infos.Montant} euros</p>
<p>Description :</p>
<p>{$infos.Description}</p>
</div>
{/foreach}
</div>
<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p>