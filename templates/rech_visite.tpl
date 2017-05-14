{include file="enteted.html"}
<link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
  <h1 id="titre">Suivi des visites</h1>
<p>Ruche : {$Nom_Ruche}</p>
  <form method="POST" action="" name="VoirVisite">
  <input type="hidden" name="Rech_visite" value="1">
  <p>Recherche des visites :</p>
  	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
    <p><label for="DateDebut">Date de la plus ancienne : </label><input name="DateDebut" type="text" onclick="ds_sh(this);"></p>
		<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
<p><label for="DateFin">Date de la plus r&eacute;cente : </label><input name="DateFin" type="text" onclick="ds_sh(this);"></p>

<p>(Si les champs sont vides, toutes les visites seront affich&eacute;es, si une des dates n'est pas mentionn&eacute;e, alors ce sera la valeur par d&eacute;faut (la plus ancienne ou la plus nouvelle suivant le cas)</p>
    <input value="Rechercher" name="a" type="submit">
 
  </form>
  <p><a href="stat_ruche.php" id="LienRetour">Retour</a></p> 
