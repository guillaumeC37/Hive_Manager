<?php
/* Smarty version 3.1.30, created on 2017-03-10 18:38:49
  from "C:\wamp\www\Gestion_Rucher\templates\voir_rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2e4a9efbd86_44742060',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5763b661e3d51808c77e748a3724673b4ba473d7' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\voir_rucher.tpl',
      1 => 1488225418,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2e4a9efbd86_44742060 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <?php echo '<script'; ?>
 src="script/rucher_ruche.js"><?php echo '</script'; ?>
>
 <link rel="stylesheet" href="style/default/rucher_rucher.css">
 <link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
    <h1 id="titre"> Gestion du rucher</h1>
    <p>Nom : <?php echo $_smarty_tpl->tpl_vars['NomRucher']->value;?>
</p>
	<p>Num&eacute;ro : <?php echo $_smarty_tpl->tpl_vars['NumRucher']->value;?>
</p>
    <p>Etat : <img src="images/<?php echo $_smarty_tpl->tpl_vars['EtatRucher']->value;?>
.png"></p>
    <div id="contenu_rucher">
      <p class="item">Ruches</p>
	  <form name="visuRuche" method="post" action="voir_ruche.php">
	  <input type="hidden" name="id_ruche" value="0">
      <ul>
	  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_ruche']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
        <li>
          <div class="logo"><a href="#" onclick="ouvre_ruche(<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_R'];?>
)"><img src="images/<?php echo $_smarty_tpl->tpl_vars['infos']->value['Photo'];?>
.png"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_R'];?>
</a></div>
        </li>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <li>
          <p><div class="logo"><a href="ajout_ruche.php"><img src="images/ruche_add.png">Ajouter une ruche</a></div></p>
        </li>
      </ul>
	  </form>
      <hr>
      <p class="item">Divers</p>
      <ul>
        <li>
          <p><div class="logo"><a href="info_rucher.php"><img src="images/information.png">Informations</a></div></p>
        </li>
		<li>
          <p><div class="logo"><a href="edit_rucher.php"><img src="images/edit1.png">Editions</a></div></p>
        </li>
		<li>
          <p><div class="logo"><a href="aide.php?Id_Page=2" target="_blank"><img src="images/help.png">Aide</a></div></p>
        </li>
      </ul>
    </div>
	<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p>
 <?php }
}
