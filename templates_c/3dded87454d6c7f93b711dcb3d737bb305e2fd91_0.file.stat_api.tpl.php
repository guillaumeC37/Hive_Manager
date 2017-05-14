<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:37:23
  from "C:\wamp\www\Gestion_Rucher\templates\stat_api.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e1739d3f26_71502337',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3dded87454d6c7f93b711dcb3d737bb305e2fd91' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_api.tpl',
      1 => 1488221817,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3e1739d3f26_71502337 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/stat_api.css">
<?php echo '<script'; ?>
 src="script/ajax.js"><?php echo '</script'; ?>
>
  </head>
<body>
 <h1 id="titre">Statistiques apiculteur</h1>
<p class="titre_table">Liste des ruchers et leur population</p>
<table id="table_rucher">
<tr>
<th>Nom du rucher</th><th>Nombre de ruches</th>
</tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_rucher']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['infos']->value['Qtte'];?>
</td>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>
<p class="titre_table">R&eacute;sum&eacute; des r&eacute;coltes</p>
<table id="table_rucher">
<tr>
<th>Type de miel</th><th>Quantité</th>
</tr>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ListeRecolte']->value, 'infos3');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos3']->value) {
?>
<tr>
<td><?php echo $_smarty_tpl->tpl_vars['infos3']->value['Nom'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['infos3']->value['Poids'];?>
 kg</td>
</tr>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</table>
<p class="titre_table">Informations résumées des ruches par rucher</p>
<p><label for="cb_listerucher">Liste des ruchers : </label><select name="cb_listerucher" onchange="ChercheRuche(this)">
<option value="-1" selected>--</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ListeRucher']->value, 'infos2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos2']->value) {
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['infos2']->value['Id'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos2']->value['Nom'];?>
</option>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</select> <label for="listeruche"> Ruches : </label><select name="listeRuche" id="SELECT_RUCHE" onchange="ChargeRuche(this)"><option value="-1">--</option></select></p>
<div id="listerucher">

</div>
<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p><?php }
}
