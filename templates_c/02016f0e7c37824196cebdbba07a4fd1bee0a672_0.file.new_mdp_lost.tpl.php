<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:15:33
  from "C:\wamp\www\Gestion_Rucher\templates\new_mdp_lost.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3dc558288e0_41544059',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '02016f0e7c37824196cebdbba07a4fd1bee0a672' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\new_mdp_lost.tpl',
      1 => 1488225670,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3dc558288e0_41544059 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
</head>
  <body>
    <h1 id="titre">Formulaire de modification de mot de passe</h1>
	<form name="add_appi" method="post" action="new_mdp.php">
	<input type="hidden" name="newMDP" value="1">
	<input type="hidden" name="Id_Api" value="<?php echo $_smarty_tpl->tpl_vars['Id_Api']->value;?>
">
    <p><label for="pass1">Nouveau mot de passe :</label><input type="password" name="pass1" class="ChampsForm"></p>
    <p><label for="pass2">V&eacute;rification :</label><input type="password" name="pass2" class="ChampsForm" onkeyup="verifPass();"><img src="" id="mdpOK"></p>
<p><input type="submit" value="Valider"></p>
</form>
<p><a href="index.php" id="LienRetour">retour &agrave; l'index</a></p>
<?php }
}
