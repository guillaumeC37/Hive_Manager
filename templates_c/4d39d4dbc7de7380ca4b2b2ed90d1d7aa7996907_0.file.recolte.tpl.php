<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:31:14
  from "C:\wamp\www\Gestion_Rucher\templates\recolte.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e002575112_99329911',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d39d4dbc7de7380ca4b2b2ed90d1d7aa7996907' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\recolte.tpl',
      1 => 1488225650,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c3e002575112_99329911 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <?php echo '<script'; ?>
 type="text/javascript" src="script/recolte.js"><?php echo '</script'; ?>
>
 <link rel="stylesheet" href="style/default/recolte.css">
 <link rel="stylesheet" href="style/default/rucher.css">
 </head>
<body>
  <h1 id="titre">Ajout d'une r&eacute;colte</h1>
<p>Nom de la ruche :<?php echo $_smarty_tpl->tpl_vars['Nom_Ruche']->value;?>
</p>
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
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_miel']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['Id_Miel'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_Miel'];?>
</option>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</select></p>
<p class="miel" onclick="afficheformul(this);"><span id="boutonM">ajouter un type de miel</span></p>
<div  id="CacheMiel">
<p><label for="new_type">Nouveau type : </label><input name="new_type" type="text" id="NouveauNom"> <input type="button" value="Ajouter" id="MonBouton" onclick="AjouteTypeMiel()"></p>
</div>
<p><label for="Poids">Poids r&eacute;colt&eacute;* : </label><input name="Poids" type="text">&nbsp; Kg</p>
<p><input type="button" value="Valider" onclick="ValideFormVisite()"></p>
</form>
<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>

<?php }
}
