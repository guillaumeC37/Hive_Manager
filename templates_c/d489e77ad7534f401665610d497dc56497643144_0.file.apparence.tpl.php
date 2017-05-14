<?php
/* Smarty version 3.1.30, created on 2017-03-10 19:49:52
  from "C:\wamp\www\Gestion_Rucher\templates\apparence.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2f550e5aa34_52304273',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd489e77ad7534f401665610d497dc56497643144' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\apparence.tpl',
      1 => 1488503858,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2f550e5aa34_52304273 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/apparence.css">
<?php echo '<script'; ?>
 src="script/gest_apparence.js"><?php echo '</script'; ?>
>
  </head>
<body>
<h1 id="titre">Gestion de l'apparence</h1>
<form name="styleApp" method="post" action="">
<p>Apparence actuelle : <?php echo $_smarty_tpl->tpl_vars['Nom_app']->value;?>
</p>
<p><label for="">Listes des apparences : </label><select name="template" onchange="changeTemplate(this)">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_app']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['Id_App'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_App'];?>
</option>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</select></p>
<p>Apparence :</p>
<p><img src="" id="imgfond"></p>
<input type="hidden" value="1" name="changeFond">
<p><input type="submit" value="Valider"></p>
</form>
<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p><?php }
}
