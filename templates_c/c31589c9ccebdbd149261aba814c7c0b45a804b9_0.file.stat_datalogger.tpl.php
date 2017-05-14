<?php
/* Smarty version 3.1.30, created on 2017-03-10 18:23:26
  from "C:\wamp\www\Gestion_Rucher\templates\stat_datalogger.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2e10e53e752_53830371',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c31589c9ccebdbd149261aba814c7c0b45a804b9' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_datalogger.tpl',
      1 => 1489166602,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2e10e53e752_53830371 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/stat_data.css">
  </head>
<body>
 <h1 id="titre">Statistiques du datalogger</h1>
    <p>Relev&eacute;s du <?php echo $_smarty_tpl->tpl_vars['DateDebut']->value;?>
 au <?php echo $_smarty_tpl->tpl_vars['DateFin']->value;?>
</p>
    <p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Ruche']->value;?>
</p>
	<div id="statmoy">
	<h2>Valeurs moyennes des relev&eacute;s</h2>
	<p>Hygrométrie int&eacute;rieure : <?php echo $_smarty_tpl->tpl_vars['MoyHygroInt']->value;?>
%</p>
	<p>Hygrométrie ext&eacute;rieure : <?php echo $_smarty_tpl->tpl_vars['MoyHygroExt']->value;?>
%</p>
	<p>Température int&eacute;rieure : <?php echo $_smarty_tpl->tpl_vars['MoyTempInt']->value;?>
&deg;</p>
	<p>Température ext&eacute;rieure : <?php echo $_smarty_tpl->tpl_vars['MoyTempExt']->value;?>
&deg;</p>
	<p>Poids : <?php echo $_smarty_tpl->tpl_vars['MoyPoids']->value;?>
 kg</p>
	</div>
    <p class="Titregraph">Relev&eacute; de poids</p>
    <p><img src="<?php echo $_smarty_tpl->tpl_vars['ImagePoids']->value;?>
" alt="releve poids"></p>
    <p class="Titregraph">Relev&eacute; de temp&eacute;ratures</p>
    <p><img src="<?php echo $_smarty_tpl->tpl_vars['ImageTemp']->value;?>
" alt="releve temperature"></p>
    <p class="Titregraph">Relev&eacute; hygrom&eacute;trique</p>
	<p><img src="<?php echo $_smarty_tpl->tpl_vars['ImageHygro']->value;?>
" alt="releve hygrometrie"></p>
<p><a href="stat_ruche.php"id="LienRetour">Retour &agrave; aux statistiques</a></p><?php }
}
