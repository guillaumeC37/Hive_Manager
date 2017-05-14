<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:47:00
  from "C:\wamp\www\Gestion_Rucher\templates\edit_rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3c7942bab61_27014023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6cd297d6404d1881a0276f2bf8acefea6114396d' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\edit_rucher.tpl',
      1 => 1488225810,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3c7942bab61_27014023 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/edit_rucher.css">
  </head>
<body>
<h1 id="titre">Editions des documents du rucher</h1>
<ul>
  <li><a href="declare_rucher.php">Fac simil&eacute; d&eacute;claration de rucher </a><span class="texte">(ceci n'est pas un document officiel. Pour effectuer la d&eacute;claration, se rendre sur <a href="https://agriculture-portail.6tzen.fr/default/requests/Cerfa13995/">le site officiel</a>.)</span></li>
  <li><a href="stat_rucher.php">Statistiques sur le rucher</a></li>
</ul>
<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
	<?php }
}
