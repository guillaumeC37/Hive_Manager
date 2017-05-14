<?php
/* Smarty version 3.1.30, created on 2017-03-11 16:10:32
  from "C:\wamp\www\Gestion_Rucher\templates\erreur_version.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c413688cb3f4_49325867',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbf7e7c454d0241b31c96895eee0bef6317bc8e2' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\erreur_version.tpl',
      1 => 1487291757,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c413688cb3f4_49325867 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
<h1 id="titre">Erreur de version.</h1>
<p>Veuillez mettre &agrave; jour la version du logiciel ou de la base de donn&eacute;es.</p>
<p>Version base attendue :<?php echo $_smarty_tpl->tpl_vars['VersionBase']->value;?>
</p>
<?php }
}
