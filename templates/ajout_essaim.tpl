{include file="enteted.html"}  
<script src="script/essaim.js"></script>
<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/voir_essaim.css">
 </head>
 <body>
    <h1 id="titre">Gestion des essaims</h1>
	<p>Ruche : {$Nom_RucheSel}</p>
	<div id="affecte_field">
	<form name="aff_essaim"  method="post" action="affecte_essaim.php">
	<fieldset>
	<legend>R&eacute;affecter un essaim &agrave; une ruche</legend>
	<div id="liste_essaim" class="c1">
	<p>Liste des essaims existants et leur affectation</p>
	<p>Choisir l'essaim &agrave; r&eacute;affecter</p>
	<p><select name="EssaimE" multiple="multiple">
	{foreach from=$liste_essaims item=infos}
          <option value="{$infos.ID_E}">{$infos.NomE} - {$infos.NomR}</option>
		{/foreach}
    </select></p>
	<input type="hidden" name="reaffecte" value="1">
	<p><input type="button" value="re affecter" onclick="ControlIDEssaim(2)"></p>
	</div>
	<div id="avertissement" class="c1">
	<p>Attention, une r&eacute;affectation d'un essaim vide la ruche pr&eacute;c&eacute;demment affect&eacute;e !</p>
	</div>
	</fieldset>
	</form>
    </div>
	<div id="cree_essaim">
	<form name="add_essaim"  method="post" action="creer_essaim.php">
	<fieldset>
    <legend>Cr&eacute;ation d'un essaim :</legend>
	<p> * champs obligatoires</p>
     <label for="Nom_Essaim">Nom de l'essaim* : </label><input name="Nom_Essaim" type="text"><br>
      <p><label for="Espece">Esp&egrave;ce : </label><input name="Espece" type="text"></p>
<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>	  
      <p><label for="DateC">Date de mise en ruche* (jj/mm/aaaa) : </label><input name="DateC" type="text" onclick="ds_sh(this);"></p>
      <p><label for="LieuC">Lieu de capture : </label><input name="LieuC" type="text"></p>
      <p><label for="Age_R">Age de la reine : </label><input name="Age_R" type="text"></p>
      <p><label for="Or_R">Origine de la reine : </label><input name="Or_R" type="text"></p>
      <p> <label for="OriE">Origine de l'essaim* : </label>
        <select name="OriE">
          {foreach from=$liste_origines item=infos}
          <option value="{$infos.Id_O}">{$infos.Nom_O}</option>
		{/foreach}
        </select>
      </p>
		<input type="hidden" name="creer_essaim" value="1">
	<p><input type="button" value="Cr&eacute;er l'essaim" onclick="VerifForm()"></p>
	  </fieldset>  
    </form>
	</div>
	<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
