<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:15:17
  from "C:\wamp\www\Gestion_Rucher\templates\mdp.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3dc4528f060_62681609',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '220f2d023831cb8f7ae9ff6123385949f5370116' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\mdp.tpl',
      1 => 1488225721,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3dc4528f060_62681609 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body> 
<form name="demande" action="mdp_oubli.php" method="post">
<input type="hidden" name="demande" value="1">
<p><label for="login">Login : </label><input type="text" name="login"></p>
<p>Question : <select name="question">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_question']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
	  <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['Id_Q'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_Q'];?>
</option>
	  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

</select></p>
<p><label for="reponse">R&eacute;ponse &agrave; la question : </label><input type="text" name="reponse"></p>
<p>Attention, il n'y a pas d'autres moyen de r&eacute;cup&eacute;rer votre mot de passe que celui-ci.</p>
<p><input type="submit" value="Valider"></p>
</form>
<p><a href="index.php" id="LienRetour">retour &agrave; l'index</a></p>
<?php }
}
