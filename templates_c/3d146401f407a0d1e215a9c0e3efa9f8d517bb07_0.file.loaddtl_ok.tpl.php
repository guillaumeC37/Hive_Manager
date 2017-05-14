<?php
/* Smarty version 3.1.30, created on 2017-03-11 16:03:19
  from "C:\wamp\www\Gestion_Rucher\templates\loaddtl_ok.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c411b7ceb855_64329779',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d146401f407a0d1e215a9c0e3efa9f8d517bb07' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\loaddtl_ok.tpl',
      1 => 1489244038,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c411b7ceb855_64329779 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
  </head>
<body>
<h1 id="titre">R&eacute;cup&eacute;ration des information d'un datalogger</h1>
<p>Il y a eu <?php echo $_smarty_tpl->tpl_vars['NbreLignes']->value;?>
 enregistrements r&eacute;cup&eacute;r&eacute;s correctement.</p>
<p><a href="loaddatalogger.php"id="LienRetour">Retour &agrave; &agrave; la page datalogger</a></p><?php }
}
