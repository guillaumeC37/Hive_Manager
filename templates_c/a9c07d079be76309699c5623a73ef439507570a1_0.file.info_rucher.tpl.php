<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:50:19
  from "C:\wamp\www\Gestion_Rucher\templates\info_rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3c85bcce496_59949346',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a9c07d079be76309699c5623a73ef439507570a1' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\info_rucher.tpl',
      1 => 1488225879,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3c85bcce496_59949346 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/infos.css">
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
  <h1 id="titre">Informations rucher</h1>
  <p>Apiculteur : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['Nom_prenom']->value;?>
</span></p>
  <p>Nom du rucher : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NomRucher']->value;?>
</span></p>
  <p>Num&eacute;ro de rucher :<span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NumRucher']->value;?>
</span></p>
  <p>Activit&eacute; :<img src="images/<?php echo $_smarty_tpl->tpl_vars['Actif']->value;?>
.png"</p></p>
  <p>localisation : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['Loc']->value;?>
</span></p>
  <p>Coordonn&eacute;es GPS :<span class="info_item"><?php echo $_smarty_tpl->tpl_vars['GPS']->value;?>
</span></p>
  <p>Observations :</p>
  <p><span id="Observations"><?php echo $_smarty_tpl->tpl_vars['Observations']->value;?>
</span></p>
  <p id="modif_btn"><a href="modif_rucher.php">Modifier</a></p>
  <p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
	<?php }
}
