{include file="enteted.html"}
 <script type="text/javascript" src="script/visite.js"></script>
 <link rel="stylesheet" href="style/default/visite.css">
 <link rel="stylesheet" href="style/default/rucher.css">
  </head> 
 <body>
    <h1 id="titre">Ajout d'une visite</h1>
	<p id="idruche">Ruche : {$Nom_Ruche}</p>
	<form name="visite" action="visite.php" method="post">
	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
    <p><label for="dateVisite">Date de la visite *: </label>
      <input type="text" name="dateVisite" onclick="ds_sh(this);" />
    </p>
    <div id="Observations" class="groupbox">
      <h1>Observations</h1>
      <p><label for="climat">temps* : </label>
        <select name="climat">
		  {foreach from=$liste_meteo item=infos}
	  <option value="{$infos.ID_TEMPS}">{$infos.NOM_TEMPS}</option>
	  {/foreach}
        </select>
      </p>
      <p><label for="Hgro">Hygrom&eacute;trie :&nbsp;</label><input name="Hygro" type="text"> %</p>
      <p><label for="temp">Temp&eacute;rature ext&eacute;rieure :&nbsp;</label><input name="temp" type="text"></p>
      <p><label for="poids">Poids :&nbsp;</label><input name="poids" type="text"></p>
    </div>
    <div id="Essaim" class="groupbox">
      <h1>Essaim</h1>
      <p><label for="comportement">Comportement de l'essaim :&nbsp;</label><input name="comportement" type="text"></p>
      <p><label for="population">Population :&nbsp;</label><input name="population" type="text"></p>
       <p class="maladie"><input name="maladie" type="checkbox" id="cbmaladie">Maladie&nbsp;
        <select name="maladielist" id="selectmaladie">
           {foreach from=$liste_maladie item=infos}
	  <option value="{$infos.idmaladie}" {$infos.selected}>{$infos.Nom_Maladie}</option>
	  {/foreach}
        </select>
      </p>
     <p class="maladie"  onclick="afficheformul();"><span id="boutonM">Ajouter une maladie</span></p>
	 <div  id="CacheMaladie">
	  <p><label for="NlleMaladie">Ajouter une nouvelle maladie : </label><input type="text" name="NlleMaladie" id="NouveauNom"></p>
	  <input type="hidden" name="add_maladie" id="add_maladie" value="-1">
	  <p><input type="button" value="Ajouter la maladie" onclick="ajoutemaladie();" id="MonBouton"></p>
	  </div>
      <p><input name="reine" value="true" type="checkbox">&nbsp;Reine visible</p>
    </div>
    <p><input name="nourissage" value="true" type="checkbox">&nbsp;<label for="nourrissage_text">Nourrissage:&nbsp;</label><input name="nourrissage_text" type="text"></p>
    <p><input name="travaux" value="true" type="checkbox">&nbsp;Travaux &agrave; pr&eacute;voir</p>
    <p>Notes&nbsp; :<br><textarea name="notes"></textarea></p>
	<input type="hidden" value="1" name="AddVisite">
    <p class="pboutons_formulaires"><input class="boutons_formulaires" value="Valider" name="Submit" type="button" onclick="ValideFormVisite();"><input class="boutons_formulaires" value="Annuler" name="cancel" type="reset"></p>
   <p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
   </form>   

