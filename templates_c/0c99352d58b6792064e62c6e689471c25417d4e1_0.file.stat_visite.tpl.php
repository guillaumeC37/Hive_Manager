<?php
/* Smarty version 3.1.30, created on 2017-03-11 13:07:07
  from "C:\wamp\www\Gestion_Rucher\templates\stat_visite.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e86b6fcf29_68275309',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c99352d58b6792064e62c6e689471c25417d4e1' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_visite.tpl',
      1 => 1488225505,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3e86b6fcf29_68275309 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/stat_visite.css">
<?php echo '<script'; ?>
 src="script/stat_visite.js"><?php echo '</script'; ?>
>
  </head>
<body>
  <h1 id="titre">Historique des visites sur la ruche <?php echo $_smarty_tpl->tpl_vars['Nom_Ruche']->value;?>
</h1>
  <p>Recherche du <?php echo $_smarty_tpl->tpl_vars['DateDebut']->value;?>
 au <?php echo $_smarty_tpl->tpl_vars['DateFin']->value;?>
</p>
  <p><a href="documents/stat_visitepdf.php" target="_blank"><img src="images/edit2.png" alt="imprimer"></a></p>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_visite']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
<div class="NewVisite">
	<div class="EnteteVisite">
		<p>Date de la visite : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Date_V'];?>
<span class="voir" onclick="Change(<?php echo $_smarty_tpl->tpl_vars['infos']->value['Numero'];?>
,this)">Afficher</span></p>
	</div>
	<input type="hidden" id="visu<?php echo $_smarty_tpl->tpl_vars['infos']->value['Numero'];?>
" value="0">
    <div class="InfoVisite" id="visite<?php echo $_smarty_tpl->tpl_vars['infos']->value['Numero'];?>
">
		<fieldset name=""><legend>Informations sur la ruche </legend>
			<p><span class="definition">Comportement de l'essaim</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Comportement'];?>
<br>
			<span class="definition">Etat de la population</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Population'];?>
<br>
			<span class="definition">Maladie</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Maladie'];?>
 <?php echo $_smarty_tpl->tpl_vars['infos']->value['NomMaladie'];?>
<br>
			<span class="definition">Reine visible</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['ReineVisible'];?>
</p>
		</fieldset>
		<fieldset name=""><legend>Mesures effectu&eacute;es :</legend>
			<p><span class="definition">Temp&eacute;rature</span> :<?php echo $_smarty_tpl->tpl_vars['infos']->value['Temperature'];?>
<br>
			<span class="definition">Climat</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Climat'];?>
<br>
			<span class="definition">Hygrom&eacute;trie</span> :<?php echo $_smarty_tpl->tpl_vars['infos']->value['Hygro'];?>
<br>
			<span class="definition">Poids</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Poids'];?>
</p>
		</fieldset>
		<fieldset name=""><legend>Actions effectu&eacute;es :</legend>
			<p><span class="definition">Nourrissage </span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Nourrissage'];?>
 <?php echo $_smarty_tpl->tpl_vars['infos']->value['Type_Nourrissage'];?>
<br>
			<span class="definition">Travaux &agrave; pr&eacute;voir</span> : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Travaux'];?>
</p>
		</fieldset>
		<p>Notes :<br>
		<span class="notes"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Notes'];?>
</span></p>
	</div>  
</div>
 <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<p><a href="stat_visite.php" id="LienRetour">Retour</a></p> 
<?php }
}
