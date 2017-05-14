<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:09:06
  from "C:\wamp\www\Gestion_Rucher\templates\ajout_essaim.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3beb2430621_23869332',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d585785497a1c28b08416347f7269ee17555e8d' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\ajout_essaim.tpl',
      1 => 1488225869,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c3beb2430621_23869332 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  
<?php echo '<script'; ?>
 src="script/essaim.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/voir_essaim.css">
 </head>
 <body>
    <h1 id="titre">Gestion des essaims</h1>
	<p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Nom_RucheSel']->value;?>
</p>
	<div id="affecte_field">
	<form name="aff_essaim"  method="post" action="affecte_essaim.php">
	<fieldset>
	<legend>R&eacute;affecter un essaim &agrave; une ruche</legend>
	<div id="liste_essaim" class="c1">
	<p>Liste des essaims existants et leur affectation</p>
	<p>Choisir l'essaim &agrave; r&eacute;affecter</p>
	<p><select name="EssaimE" multiple="multiple">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_essaims']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_E'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['NomE'];?>
 - <?php echo $_smarty_tpl->tpl_vars['infos']->value['NomR'];?>
</option>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_origines']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['Id_O'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_O'];?>
</option>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>
      </p>
		<input type="hidden" name="creer_essaim" value="1">
	<p><input type="button" value="Cr&eacute;er l'essaim" onclick="VerifForm()"></p>
	  </fieldset>  
    </form>
	</div>
	<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
<?php }
}
