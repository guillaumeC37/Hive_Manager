{include file="enteted.html"}
<script src="script/stat_verifdate.js"></script>
<link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
  <h1 id="titre">Relev&eacute; des pes&eacute;es</h1>
<p>Ruche : {$Ruche}</p>
<p>Les relev&eacute;s s'appuient sur les donn&eacute;es provenant des visites et du datalogger si il y en a un.</p>
<p>Si aucune visite n'est renseign&eacute;e avec des pes&eacute;es, mais qu'il y a un datalogger, il faut afficher alors les statistiques du datalogger.</p>
  <form method="POST" action="" name="VoirRecolte">
  <input type="hidden" name="Rech_temp" value="1">
  <p>S&eacute;lection des dates de recherche :</p>
  	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
    <p><label for="DateDebut">Date de la plus ancienne : </label><input name="DateDebut" id="DateDebut" type="text" onclick="ds_sh(this);"></p>
		<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
<p><label for="DateFin">Date de la plus r&eacute;cente : </label><input name="DateFin" type="text" id="DateFin" onclick="ds_sh(this);"></p>

<p>(Si les champs sont vides, toutes les  r&eacute;coltes seront affich&eacute;es, si une des dates n'est pas mentionn&eacute;e, alors ce sera la valeur par d&eacute;faut (la plus ancienne ou la plus nouvelle suivant le cas)</p>
    <input value="Rechercher" type="button" onclick="CompareDate()">
 
  </form>
  <p><a href="stat_ruche.php" id="LienRetour">Retour</a></p> 
