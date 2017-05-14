{include file="enteted.html"}
 <script type="text/javascript" src="script/recolte.js"></script>
 <link rel="stylesheet" href="style/default/recolte.css">
 <link rel="stylesheet" href="style/default/rucher.css">
 </head>
<body>
  <h1 id="titre">Ajout d'une r&eacute;colte</h1>
<p>Nom de la ruche :{$Nom_Ruche}</p>
<p>* champs obligatoires</p>
	<form name="recolte" action="" method="post">
	<input type="hidden" name="Add_Recolte" value="1">
	<input type="hidden" name="Temp_Miel" value="">
	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
    <p><label for="dateVisite">Date de la r&eacute;colte *: </label>
      <input type="text" name="dateRecolte" onclick="ds_sh(this);" />
    </p>
<p><label for="Type_Miel">Type de miel : </label><select name="Type_Miel" id="selectmiel">
{foreach from=$liste_miel item=infos}
<option value="{$infos.Id_Miel}">{$infos.Nom_Miel}</option>
{/foreach}
</select></p>
<p class="miel" onclick="afficheformul(this);"><span id="boutonM">ajouter un type de miel</span></p>
<div  id="CacheMiel">
<p><label for="new_type">Nouveau type : </label><input name="new_type" type="text" id="NouveauNom"> <input type="button" value="Ajouter" id="MonBouton" onclick="AjouteTypeMiel()"></p>
</div>
<p><label for="Poids">Poids r&eacute;colt&eacute;* : </label><input name="Poids" type="text">&nbsp; Kg</p>
<p><input type="button" value="Valider" onclick="ValideFormVisite()"></p>
</form>
<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>

