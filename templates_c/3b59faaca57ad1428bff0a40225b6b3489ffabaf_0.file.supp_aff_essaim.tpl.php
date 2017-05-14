<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:09:30
  from "C:\wamp\www\Gestion_Rucher\templates\supp_aff_essaim.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3becae4e9e0_25540057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b59faaca57ad1428bff0a40225b6b3489ffabaf' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\supp_aff_essaim.tpl',
      1 => 1488225499,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c3becae4e9e0_25540057 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  
<?php echo '<script'; ?>
 src="script/essaimsupp.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="style/default/voir_essaim.css">
<link rel="stylesheet" href="style/default/rucher.css">
 </head>
 <body>
    <h1 id="titre">Gestion des essaims</h1>
	<p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Nom_RucheSel']->value;?>
</p>
	<p> Essaim actuel : <?php echo $_smarty_tpl->tpl_vars['NomEssaim']->value;?>
</p>
	<form name="aff_essaim"  method="post" action="affecte_essaim.php"> <!-- affecte_essaim -->
	<div id="affecte_field">
	<fieldset>
	<legend>R&eacute;affecter un essaim &agrave; la ruche</legend>
	<div id="liste_essaim" class="c1">
	<p>Liste des essaims existants et leur affectation</p>
	<p>Choisir l'essaim &agrave; r&eacute;affecter</p>
	<p><select name="EssaimE" multiple="multiple">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_essaims']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_E'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['NomE'];?>
 - <?php echo $_smarty_tpl->tpl_vars['infos']->value['NomR'];?>
</option>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </select></p>
	<input type="hidden" name="reaffecte" value="2">
	<input type="hidden" name="NomEssaim" value="<?php echo $_smarty_tpl->tpl_vars['NomEssaim']->value;?>
">
	<p><input type="button" value="re affecter" onclick="ControlIDEssaim(2)"></p>
	</div>
	<div id="avertissement" class="c1">
	<p>Attention, une r&eacute;affectation d'un essaim supprime l'essaim existant dans la ruche actuelle, et vide la ruche pr&eacute;c&eacute;demment affect&eacute;e !</p>
	</div>
	</fieldset>
    </div>
	<div id="supp_essaim">
	<p><input type="button" value="Supprimer l'essaim" onclick="SuppEssaim(3)"></p>
	</div>
   </form>
	<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
<?php }
}
