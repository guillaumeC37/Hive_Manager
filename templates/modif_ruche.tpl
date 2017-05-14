{include file="enteted.html"}
<link rel="stylesheet" href="style/default/modif_ruche.css">
<link rel="stylesheet" href="style/default/rucher.css">
<script src="script/modif_ruche.js"></script>
  </head>
  <body onload="copieLaDate()">
    <h1 id="titre">Informations sur la ruche</h1>
    <p>Ruche&nbsp; : <span class="info_item">{$Nom_Ruche}</span></p>
	<p>Rucher d'appartenance&nbsp; : <span class="info_item">{$Nom_Rucher}</span></p>
	<form name="modif_ruche" action="modif_ruche.php" method="post">
	<input type="hidden" name="Mod_Ruche" value="1">
    <div id="informations">
	<p>* champs obligatoires</p>
	<p><label for="NomRuche">Nom de la ruche* :&nbsp;</label><input name="NomRuche" type="text" value="{$Nom_Ruche}" onchange="Changer(this)"></p>
    <p><label for="rucher_aff">Rucher : </label><select name="rucher_aff"  onchange="Changer(this)">
	{foreach from=$liste_Rucher item=infos}
          <option value="{$infos.ID_R}" {$infos.IsSelect}>{$infos.Nom_R}</option>
		 {/foreach}
		 </select>
<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
		 <p><label for="DateCrea">Date de cr&eacute;ation :&nbsp;</label><input name="DateCrea" type="text" value="{$Date_Ruche}" onclick="ds_sh(this);"  onchange="Changer(this)"></p>
    <p><label for="NumRuche">Num&eacute;ro de la ruche* :</label><input name="NumRuche" type="text" value="{$Num_Ruche}"  onchange="Changer(this)"></p>
    <p>Type de ruche : <span class="info_item">{$NomType}</span></p>
    <p>Nombe de cadres : <span class="info_item">{$NbreCadres}</span></p>
    <p><label for="Etat">Etat :&nbsp;</label>
          <select name="Etat"  onchange="Changer(this)">
          {foreach from=$liste_Etat item=infos}
          <option value="{$infos.ID_E}" {$infos.IsSelect}>{$infos.Nom_E}</option>
		 {/foreach}
          </select>
        </p>
    <p>Type de hausse : <span class="info_item">{$NomHausse}</span></p>
    <p><label for="Hausses">Nombre de hausses* :&nbsp;</label><input max="30" min="0" name="Hausses" type="number" value="{$NbreHausses}" onchange="Changer(this)"></p>
    <p>Observations :</p>
    <p><textarea name="Obs"  onchange="Changer(this)">{$Obs}</textarea></p>
	<p><input type="button" value="Modifier" onclick="verif_form()"></p>
	</div>
	</form>
	<p><a href="voir_info_ruche.php" id="LienRetour">Retour aux informations de la ruche</a></p>
