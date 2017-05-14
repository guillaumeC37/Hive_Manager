{include file="entete_open.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
<link rel="stylesheet" href="style/{$TemplateUser}/stat_api.css">
<script src="script/ajax.js"></script>
  </head>
<body>
 <h1 id="titre">Statistiques apiculteur</h1>
<p class="titre_table">Liste des ruchers et leur population</p>
<table id="table_rucher">
<tr>
<th>Nom du rucher</th><th>Nombre de ruches</th>
</tr>
{foreach from=$liste_rucher item=infos}
<tr>
<td>{$infos.Nom}</td><td>{$infos.Qtte}</td>
</tr>
{/foreach}
</table>
<p class="titre_table">R&eacute;sum&eacute; des r&eacute;coltes</p>
<table id="table_rucher">
<tr>
<th>Type de miel</th><th>Quantité</th>
</tr>
{foreach from=$ListeRecolte item=infos3}
<tr>
<td>{$infos3.Nom}</td><td>{$infos3.Poids} kg</td>
</tr>
{/foreach}
</table>
<p class="titre_table">Informations résumées des ruches par rucher</p>
<p><label for="cb_listerucher">Liste des ruchers : </label><select name="cb_listerucher" onchange="ChercheRuche(this)">
<option value="-1" selected>--</option>
{foreach from=$ListeRucher item=infos2}
<option value="{$infos2.Id}">{$infos2.Nom}</option>
{/foreach}
</select> <label for="listeruche"> Ruches : </label><select name="listeRuche" id="SELECT_RUCHE" onchange="ChargeRuche(this)"><option value="-1">--</option></select></p>
<div id="listerucher">

</div>
<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p>