<?php
/* Smarty version 3.1.30, created on 2017-03-10 19:56:29
  from "C:\wamp\www\Gestion_Rucher\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2f6dddfce85_82055482',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c6ab794a5a45dcf666af25d6fca5f7ac56686332' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\index.tpl',
      1 => 1487872383,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2f6dddfce85_82055482 (Smarty_Internal_Template $_smarty_tpl) {
?>
  <?php $_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <link rel="stylesheet" href="style/default/rucher.css">
  <?php echo '<script'; ?>
 src="script/rucher.js"><?php echo '</script'; ?>
> 
  </head>
  <body<?php echo $_smarty_tpl->tpl_vars['Ajout']->value;?>
>
    <h1 id="titre"> Assistant de gestion de rucher</h1>
	<div id="menu">
      <form name="loginform" action="index.php" method="post">
	  <ul>
	  <li><input name="login" type="text" value="login" onclick="vide_champ(this)"><input name="pass" type="password"><a href="#" onclick="submitlogin()">Login</a></li>
      <li><a href="signIn.php">Sign In</a></li>
	  </form>
	  </ul>
	  <p id="mdp"><a href="mdp_oubli.php">mot de passe oubli&eacute;</a></p>
    </div>
    <div id="presentation"><p>Bienvenue dans <?php echo $_smarty_tpl->tpl_vars['NomLogiciel']->value;?>
, un logiciel permettant de g&eacute;rer
      votre activit&eacute; d'apiculture.</p>
    <p>Ce logiciel est un environnement multi-utilisateur, ce qui permet
      &agrave; plusieurs apiculteurs d'utiliser le m&ecirc;me syst&egrave;me
      sans pour autant que leurs informations soient connues des autres
      utilisateurs.</p>
    <p>Avec cette application, vous serez capable de g&eacute;rer vos ruchers,
      vos ruches, ainsi que d'autres caract&eacute;ristiques li&eacute;es
      &agrave; votre activit&eacute;.</p>
    <p>Le syst&egrave;me est compatible avec l'enregisteur de donn&eacute;es de
      ruches (en cours de d&eacute;veloppement) permettant un import direct des
      informations de vos ruches dans l'outil de travail, ce qui apporte une
      analyse des statistiques de l'exploitation.</p>
    <p>Une aide est pr&eacute;sente dans les diff&eacute;rentes pages afin de
      faciliter l'utilisation.</p></div>
	  <div>
	  <p>Ce site utilise des cookies pour fonctionner. Ces cookies sont &agrave; r&ocirc;le de gestion de sessions, et aucun cookies publicitaire ou autre n'est utilis&eacute;.<br>
	  En utilisant ce logiciel, vous acceptez de fait ces cookies.</p>
	  </div>

<?php }
}
