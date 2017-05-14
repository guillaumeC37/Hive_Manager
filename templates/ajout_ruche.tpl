{include file="enteted.html"}
 <link rel="stylesheet" href="style/default/add_ruche.css">
 <link rel="stylesheet" href="style/default/rucher.css">
 <script src="script/addruche.js"></script>
 </head>
  <body>
    <h1 id="titre">Cr&eacute;ation d'une ruche</h1>
	<p>Ajout d'une ruche dans le rucher "{$NOM_Rucher}"</p>
	<p>* : Champs obligatoires</p>
	<form name="add_ruche" action="ajout_ruche.php" method="post">
    <p><label for="nom">Nom de la ruche* :&nbsp;<input name="nom" type="text"></p>
    <p><label for="num">Num&eacute;ro de la ruche* :&nbsp;<input name="num" type="text"></p>
    <p><label for="NbreCadre">Nombre de cadre* :&nbsp; <select name="NbreCadre">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		<option value="11">11</option>
		<option value="12">12</option>
      </select>
    </p>
	<p><label for="thausse">Type de hausse*</label> :&nbsp; <select name="thausse">
	{foreach from=$liste_hausses item=infos}
          <option value="{$infos.ID_H}">{$infos.Type_H}</option>
		{/foreach}
      </select>
    <p><label for="nbrehausse">Nombre de hausses*</label> :&nbsp;<select name="nbrehausse">
		<option value="0">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
      </select></p>
	  	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
	<p><label for="dateMES">Date de d&eacute;but d'activit&eacute;</label> :&nbsp;<input name="dateMES" type="text"  onclick="ds_sh(this);"></p>
    <p><label for="typeRuche">type de ruche*</label> :&nbsp; <select name="typeRuche">
        {foreach from=$liste_types item=infos}
          <option value="{$infos.ID_T}">{$infos.Nom_T}</option>
		{/foreach}
      </select>
    </p>
    <p><label for="etatRuche">&eacute;tat* </label>:&nbsp;
      <select name="etatRuche">
         {foreach from=$liste_etats item=infos}
          <option value="{$infos.ID_E}">{$infos.Nom_E}</option>
		{/foreach}
      </select>
    </p>
    <p><label for="Obs">Observations </label>:&nbsp;<textarea name="Obs"></textarea></p>
    <input type="hidden" name="Add_Ruche" value="1">
    <p class="pboutons_formulaires"><input  class="boutons_formulaires" value="Valider" name="Submit" type="button" onclick="SubmitRuche();"><input value="Annuler" class="boutons_formulaires" name="cancel" type="reset"></p>
    </form>
	<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
