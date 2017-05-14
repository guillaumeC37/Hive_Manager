<?php
/* Smarty version 3.1.30, created on 2017-03-10 19:49:49
  from "C:\wamp\www\Gestion_Rucher\templates\parametres.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2f54dbdc0f8_53568652',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7fcc73dd8051744c55f06d0e6de0838f268d0ed0' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\parametres.tpl',
      1 => 1488499841,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2f54dbdc0f8_53568652 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <link rel="stylesheet" href="style/default/rucher.css">
 </head>
<body>
 <h1 id="titre">Param&egrave;tres du syst&egrave;me.</h1>
    <p><a href="gestion_maladie.php">Gestion des maladies</a></p>
    <p><a href="gestion_miel.php">Gestion des types de miel</a></p>
    <p><a href="gest_apparence.php">Apparence</a></p>
	<p><a href="systeme_info.php">Informations syst&egrave;me</a></p>
	<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p>
<?php }
}
