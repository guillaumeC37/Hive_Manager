<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:44:16
  from "C:\wamp\www\Gestion_Rucher\templates\stat_poids.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e3108a0244_95644787',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f94f7f99480508276ce9f667bcf53c536b73e33' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_poids.tpl',
      1 => 1488567796,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3e3108a0244_95644787 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
  </head>
<body>
<h1 id="titre">R&eacute;sultats des relev&eacute;s hygrom&eacute;trique</h1>
<p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Ruche']->value;?>
</p>
<p>Relev&eacute; hygrom&eacute;trique entre le <?php echo $_smarty_tpl->tpl_vars['DateDebut']->value;?>
 et le <?php echo $_smarty_tpl->tpl_vars['DateFin']->value;?>
</p>
<p><img alt="graphique pesees" src="documents/<?php echo $_smarty_tpl->tpl_vars['graphique_temp']->value;?>
"></p>
<p><a href="stat_ruche.php" id="LienRetour">Retour</a></p> <?php }
}
