<?php
/* Smarty version 3.1.30, created on 2017-03-11 13:00:56
  from "C:\wamp\www\Gestion_Rucher\templates\stat_rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e6f89d9b12_98476006',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '392e3e6108a1d3bf5c958dabb0b7922ba558c8fc' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_rucher.tpl',
      1 => 1488111242,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3e6f89d9b12_98476006 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/stat_rucher.css">
  </head>
<body>
  <h1 id="titre">Statistiques du rucher</h1>
<p><span class="souslignee">Nom du rucher</span> : <?php echo $_smarty_tpl->tpl_vars['NomRucher']->value;?>
</p>
<p><span class="souslignee">Nombres de ruches dans le rucher</span> :<?php echo $_smarty_tpl->tpl_vars['NombreRuche']->value;?>
</p>
<p><span class="souslignee">Dont</span> :</p>
<div class="donnees">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ListeEtat']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
  <p><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nombre'];?>
 ruche(s) <?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom'];?>
</p>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</div>
<p><span class="souslignee">R&eacute;colte totale sur le rucher tout type confondu&nbsp;</span> : <?php echo $_smarty_tpl->tpl_vars['TotalRecolte']->value;?>
 kg.</p>
<p><span class="souslignee">Par type</span> :</p>
<div class="donnees">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['ListeRecolte']->value, 'infos2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos2']->value) {
?>
<p><?php echo $_smarty_tpl->tpl_vars['infos2']->value['NomType'];?>
 : <?php echo $_smarty_tpl->tpl_vars['infos2']->value['Poids'];?>
 kg</p>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</div>
<p><a href="documents/stat_rucher_pdf.php" target="_blank"><img src="images/edit2.png" alt="imprimer"></a></p>
<p><a href="edit_rucher.php">Retour aux &eacute;ditions</a></p><?php }
}
