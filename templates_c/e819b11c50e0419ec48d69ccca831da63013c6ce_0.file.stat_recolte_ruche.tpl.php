<?php
/* Smarty version 3.1.30, created on 2017-03-11 12:53:06
  from "C:\wamp\www\Gestion_Rucher\templates\stat_recolte_ruche.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e5229fb5b8_59140312',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e819b11c50e0419ec48d69ccca831da63013c6ce' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_recolte_ruche.tpl',
      1 => 1488225534,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3e5229fb5b8_59140312 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/recolte_ruche.css">
  </head>
<body>
  <h1 id="titre">Resultats des recherches sur la r&eacute;colte</h1>
  <p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Ruche']->value;?>
</p>
  <p>R&eacute;colte entre le <?php echo $_smarty_tpl->tpl_vars['DateDebut']->value;?>
 et le <?php echo $_smarty_tpl->tpl_vars['DateFin']->value;?>
 : </p>
<p>Poids total des r&eacute;coltes : <?php echo $_smarty_tpl->tpl_vars['Poids_total']->value;?>
 Kg</p>
<p>Poids r&eacute;colt&eacute; par type de miel :</p>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_recolte']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
<p class="ListeMiel"><?php echo $_smarty_tpl->tpl_vars['infos']->value['TypeMiel'];?>
 : <?php echo $_smarty_tpl->tpl_vars['infos']->value['Poids_Miel'];?>
 Kg</p>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<p>Graphique :</p>
 <p><img alt="graphique recolte" src="documents/<?php echo $_smarty_tpl->tpl_vars['graphique_recolte']->value;?>
"></p>
   <p><a href="stat_recolte.php" id="LienRetour">Retour</a></p> 
<?php }
}
