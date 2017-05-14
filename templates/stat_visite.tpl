{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/stat_visite.css">
<script src="script/stat_visite.js"></script>
  </head>
<body>
  <h1 id="titre">Historique des visites sur la ruche {$Nom_Ruche}</h1>
  <p>Recherche du {$DateDebut} au {$DateFin}</p>
  <p><a href="documents/stat_visitepdf.php" target="_blank"><img src="images/edit2.png" alt="imprimer"></a></p>
{foreach from=$liste_visite item=infos}
<div class="NewVisite">
	<div class="EnteteVisite">
		<p>Date de la visite : {$infos.Date_V}<span class="voir" onclick="Change({$infos.Numero},this)">Afficher</span></p>
	</div>
	<input type="hidden" id="visu{$infos.Numero}" value="0">
    <div class="InfoVisite" id="visite{$infos.Numero}">
		<fieldset name=""><legend>Informations sur la ruche </legend>
			<p><span class="definition">Comportement de l'essaim</span> : {$infos.Comportement}<br>
			<span class="definition">Etat de la population</span> : {$infos.Population}<br>
			<span class="definition">Maladie</span> : {$infos.Maladie} {$infos.NomMaladie}<br>
			<span class="definition">Reine visible</span> : {$infos.ReineVisible}</p>
		</fieldset>
		<fieldset name=""><legend>Mesures effectu&eacute;es :</legend>
			<p><span class="definition">Temp&eacute;rature</span> :{$infos.Temperature}<br>
			<span class="definition">Climat</span> : {$infos.Climat}<br>
			<span class="definition">Hygrom&eacute;trie</span> :{$infos.Hygro}<br>
			<span class="definition">Poids</span> : {$infos.Poids}</p>
		</fieldset>
		<fieldset name=""><legend>Actions effectu&eacute;es :</legend>
			<p><span class="definition">Nourrissage </span> : {$infos.Nourrissage} {$infos.Type_Nourrissage}<br>
			<span class="definition">Travaux &agrave; pr&eacute;voir</span> : {$infos.Travaux}</p>
		</fieldset>
		<p>Notes :<br>
		<span class="notes">{$infos.Notes}</span></p>
	</div>  
</div>
 {/foreach}
<p><a href="stat_visite.php" id="LienRetour">Retour</a></p> 
