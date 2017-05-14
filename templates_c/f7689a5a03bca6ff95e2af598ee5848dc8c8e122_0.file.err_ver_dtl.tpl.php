<?php
/* Smarty version 3.1.30, created on 2017-03-11 16:04:16
  from "C:\wamp\www\Gestion_Rucher\templates\err_ver_dtl.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c411f08a3af0_90432401',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7689a5a03bca6ff95e2af598ee5848dc8c8e122' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\err_ver_dtl.tpl',
      1 => 1489244363,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c411f08a3af0_90432401 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
  </head>
<body>
<h1 id="titre">R&eacute;cup&eacute;ration des information d'un datalogger</h1>
<p>Il y a un probl&egrave;me de version entre le datalogger et le syst&egrave;me<br>Version datalogger : <?php echo $_smarty_tpl->tpl_vars['VerDTL']->value;?>
<br>Version syst&egrave;me : <?php echo $_smarty_tpl->tpl_vars['VerSys']->value;?>
<br>
Aucun enregistrement n'a put &ecirc;tre enregistr&eacute;s. Veuillez mettre &agrave; jour.</p>
<p><a href="loaddatalogger.php"id="LienRetour">Retour &agrave; l'accueil</a></p><?php }
}
