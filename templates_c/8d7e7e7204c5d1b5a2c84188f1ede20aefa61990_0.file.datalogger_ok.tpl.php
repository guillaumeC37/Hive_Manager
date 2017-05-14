<?php
/* Smarty version 3.1.30, created on 2017-03-10 20:46:41
  from "C:\wamp\www\Gestion_Rucher\templates\datalogger_ok.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c302a1355153_37820735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8d7e7e7204c5d1b5a2c84188f1ede20aefa61990' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\datalogger_ok.tpl',
      1 => 1489175191,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c302a1355153_37820735 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
  </head>
<body>
<h1 id="titre">Datalogger</h1>
<p>Il vous suffit de t&eacute;l&eacute;charger le <a href="<?php echo $_smarty_tpl->tpl_vars['Lien']->value;?>
">fichier suivant </a>et de le copier sur une carte SD vierge.<br>
Ensuite, ins&eacute;rez la carte SD dans le datalogger en suivant la proc&eacute;dure indiqu&eacute;e dans le document.</p>

<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p><?php }
}
