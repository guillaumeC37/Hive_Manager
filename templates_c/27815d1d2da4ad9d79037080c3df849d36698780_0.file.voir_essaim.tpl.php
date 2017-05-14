<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:09:26
  from "C:\wamp\www\Gestion_Rucher\templates\voir_essaim.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3bec670f796_00801580',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '27815d1d2da4ad9d79037080c3df849d36698780' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\voir_essaim.tpl',
      1 => 1488225440,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3bec670f796_00801580 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
<h1 id="titre">Essaim de la ruche</h1>
	<p>Ruche : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NomRuche']->value;?>
</span></p>
	<p>Nom de l'essaim : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NomEssaim']->value;?>
</span></p>
	<div id="infoEssaim">
	<p>Esp&egrave;ce : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['Espece']->value;?>
</span></p>
    <p>Date de mise en ruche : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['DateMR']->value;?>
</span></p>
    <p>Lieu de Capture : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['Lieu']->value;?>
</span></p>
    <p>Age de la reine : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['AgeR']->value;?>
</span></p>
    <p>Origine de la reine : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['OrigR']->value;?>
</span></p>
    <p>Origine de l'essaim : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['OrigE']->value;?>
</span></p>
	<form name="" method="post" action="affecte_essaim.php">
	<input type="hidden" name="reaffecte" value="2">
	</form>
	<p><a href="supp_essaim.php">Supprimer ou affecter un autre essaim</a></p>
	<p><a href="voir_ruche.php" id="LienRetour">retour &agrave; la ruche</a></p>
	</div>
<?php }
}
