<?php
/* Smarty version 3.1.30, created on 2017-03-10 18:25:20
  from "C:\wamp\www\Gestion_Rucher\templates\stat_ruche.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2e180936496_94352100',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '592e5d9781c37bf071bbcf0eb2c40f9d46bb5c44' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_ruche.tpl',
      1 => 1488908123,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2e180936496_94352100 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/stat_ruche.css">
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
 <h1>Statistiques </h1>
  <ul>
    <li><a href="stat_visite.php">Suivi des visites</a></li>
	<li><a href="stat_temp.php">Relev&eacute; temp&eacute;ratures</a></li>
	<li><a href="stat_poids.php">Relev&eacute; poids</a></li>
	<li><a href="stat_hygro.php">Relev&eacute; hygrom&eacute;trie</a></li>
	<li><a href="stat_recolte.php">Production (r&eacute;coltes)</a></li>
	<li><a href="stat_datalogger.php">Graphique datalogger</a></li>
	<li><a href="bilan_ruche.php">Bilan de la ruche</a></li>
</ul>
<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
	<?php }
}
