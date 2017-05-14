<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:20:04
  from "C:\wamp\www\Gestion_Rucher\templates\ajout_ruche.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3c144057c11_56513773',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9827f08e668f0fc89b814912905da160d87119b0' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\ajout_ruche.tpl',
      1 => 1488225856,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c3c144057c11_56513773 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <link rel="stylesheet" href="style/default/add_ruche.css">
 <link rel="stylesheet" href="style/default/rucher.css">
 <?php echo '<script'; ?>
 src="script/addruche.js"><?php echo '</script'; ?>
>
 </head>
  <body>
    <h1 id="titre">Cr&eacute;ation d'une ruche</h1>
	<p>Ajout d'une ruche dans le rucher "<?php echo $_smarty_tpl->tpl_vars['NOM_Rucher']->value;?>
"</p>
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
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_hausses']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_H'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Type_H'];?>
</option>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_types']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_T'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_T'];?>
</option>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </select>
    </p>
    <p><label for="etatRuche">&eacute;tat* </label>:&nbsp;
      <select name="etatRuche">
         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_etats']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_E'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_E'];?>
</option>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

      </select>
    </p>
    <p><label for="Obs">Observations </label>:&nbsp;<textarea name="Obs"></textarea></p>
    <input type="hidden" name="Add_Ruche" value="1">
    <p class="pboutons_formulaires"><input  class="boutons_formulaires" value="Valider" name="Submit" type="button" onclick="SubmitRuche();"><input value="Annuler" class="boutons_formulaires" name="cancel" type="reset"></p>
    </form>
	<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
<?php }
}
