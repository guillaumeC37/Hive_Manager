<?php
/* Smarty version 3.1.30, created on 2017-03-10 18:25:23
  from "C:\wamp\www\Gestion_Rucher\templates\bilan_ruche.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2e1831de792_33275710',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '667075bef3947d00df206d76268de94270c29054' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\bilan_ruche.tpl',
      1 => 1488569768,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2e1831de792_33275710 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
  </head>
<body>
  <h1 id="titre">Bilan De la ruche</h1>
<p>Le bilan de la ruche vous permet d'enregistrer au format pdf toute l'activit&eacute; de la ruche depuis sa d&eacute;claration dans le syst&egrave;me.</p>
<p>Vous y retrouvez les courbes de r&eacute;colte, les suivis de poids, de temp&eacute;rature, d'hygrom&eacute;trie et les relev&eacute;s du datalogger.</p>
<p>Afin de profiter au maximum de l'espace, l'impression se fera en format paysage.</p>
<p><a href="documents/edit_bilanpdf.php" target="_blank"><img src="images/edit2.png" alt="imprimer"></a></p>
<p><a href="stat_ruche.php" id="LienRetour">Retour aux statistiques</a></p><?php }
}
