<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:08:19
  from "C:\wamp\www\Gestion_Rucher\templates\loaddatalogger.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3daa37c6b07_07561002',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '20eabccc00ee4fd5bc52ac80bc46c10e1c240afd' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\loaddatalogger.tpl',
      1 => 1488837510,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3daa37c6b07_07561002 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
  </head>
<body>
<h1 id="titre">R&eacute;cup&eacute;ration des information d'un datalogger</h1>
  <p>Afin de pouvoir int&eacute;grer les informations de relev&eacute; d'un datalogger, il faut ins&eacute;rer la carte SD du datalogger dans votre PC, et le charger depuis cette page.</p>
<p>Les informations seront alors automatiquement int&eacute;gr&eacute;es au logiciel (1Mo maximum).</p>
<form method="POST" action="" name="gere_type" enctype="multipart/form-data">
  <input type="hidden" name="FileLoaded" value="1">
  <input name="MAX_FILE_SIZE" value="1048576" type="hidden">
  <input name="datalogger" type="file">
  <p><input value="Envoyer" name="Valide" type="submit"></p> 
  </form>
<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p>
<?php }
}
