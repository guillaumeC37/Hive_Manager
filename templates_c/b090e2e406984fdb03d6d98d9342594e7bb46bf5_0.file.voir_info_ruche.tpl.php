<?php
/* Smarty version 3.1.30, created on 2017-03-11 11:50:01
  from "C:\wamp\www\Gestion_Rucher\templates\voir_info_ruche.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3d6596621f0_24030925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b090e2e406984fdb03d6d98d9342594e7bb46bf5' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\voir_info_ruche.tpl',
      1 => 1488225213,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3d6596621f0_24030925 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  
<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/infor.css">
<link rel="stylesheet" href="style/default/infos.css">
<?php echo '<script'; ?>
 src="script/voirruche.js"><?php echo '</script'; ?>
>
</head>
<body>
    <h1 id="titre">Informations sur la ruche</h1>
    <p>Rucher&nbsp; : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NomRucher']->value;?>
</span></p>
    <p>Nom de la ruche : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NomRuche']->value;?>
</span></p>
	<div id="infoR">
    <p>Date de cr&eacute;ation : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['DateCreation']->value;?>
</span></p>
    <p>Num&eacute;ro de la ruche :<span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NumRuche']->value;?>
</span></p>
    <p>Type de ruche : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['TypeRuche']->value;?>
</span></p>
    <p>Nombe de cadres : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NbreCadre']->value;?>
</span></p>
    <p>Etat : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['Etat']->value;?>
</span></p>
    <p>Type de hausse : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['TypeHausses']->value;?>
</span></p>
    <p>Nombre de hausses : <span class="info_item"><?php echo $_smarty_tpl->tpl_vars['NbreHausses']->value;?>
</span></p>
    <p>Observations :</p>
    <p><span id="Observations"><?php echo $_smarty_tpl->tpl_vars['Observations']->value;?>
</span></p>
	</div>
	<p><a href="genereQR.php" target="_blank" id="QRCode">G&eacute;n&eacute;rer le QR Code de la ruche</a></p>
	<p id="modif_btnr"><a href="modif_ruche.php">Modifier</a></p>
  <p id="back_btn"><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
<?php }
}
