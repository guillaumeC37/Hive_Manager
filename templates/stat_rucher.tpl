{include file="entete_open.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
<link rel="stylesheet" href="style/{$TemplateUser}/stat_rucher.css">
  </head>
<body>
  <h1 id="titre">Statistiques du rucher</h1>
<p><span class="souslignee">Nom du rucher</span> : {$NomRucher}</p>
<p><span class="souslignee">Nombres de ruches dans le rucher</span> :{$NombreRuche}</p>
<p><span class="souslignee">Dont</span> :</p>
<div class="donnees">
{foreach from=$ListeEtat item=infos}
  <p>{$infos.Nombre} ruche(s) {$infos.Nom}</p>
{/foreach}
</div>
<p><span class="souslignee">R&eacute;colte totale sur le rucher tout type confondu&nbsp;</span> : {$TotalRecolte} kg.</p>
<p><span class="souslignee">Par type</span> :</p>
<div class="donnees">
{foreach from=$ListeRecolte item=infos2}
<p>{$infos2.NomType} : {$infos2.Poids} kg</p>
{/foreach}
</div>
<p><a href="documents/stat_rucher_pdf.php" target="_blank"><img src="images/edit2.png" alt="imprimer"></a></p>
<p><a href="edit_rucher.php" id="LienRetour">Retour aux &eacute;ditions</a></p>