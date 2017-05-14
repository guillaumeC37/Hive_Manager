<?php
/* Smarty version 3.1.30, created on 2017-03-14 20:58:47
  from "C:\wamp\www\Gestion_Rucher\templates\visite.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c84b77d7d081_24469008',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4ebd9135bd6145de2481360b7cd601e6531de1b4' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\visite.tpl',
      1 => 1488225361,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c84b77d7d081_24469008 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <?php echo '<script'; ?>
 type="text/javascript" src="script/visite.js"><?php echo '</script'; ?>
>
 <link rel="stylesheet" href="style/default/visite.css">
 <link rel="stylesheet" href="style/default/rucher.css">
  </head> 
 <body>
    <h1 id="titre">Ajout d'une visite</h1>
	<p id="idruche">Ruche : <?php echo $_smarty_tpl->tpl_vars['Nom_Ruche']->value;?>
</p>
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
		  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_meteo']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
	  <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_TEMPS'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['NOM_TEMPS'];?>
</option>
	  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
           <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_maladie']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
	  <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['idmaladie'];?>
" <?php echo $_smarty_tpl->tpl_vars['infos']->value['selected'];?>
><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_Maladie'];?>
</option>
	  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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

<?php }
}
