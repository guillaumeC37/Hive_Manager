<?php
/* Smarty version 3.1.30, created on 2017-03-10 18:38:47
  from "C:\wamp\www\Gestion_Rucher\templates\voir_ruche.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2e4a7490141_60187429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df0a3f1ae3b6cfe8be53b97c2d4f1396609e7b89' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\voir_ruche.tpl',
      1 => 1488225427,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2e4a7490141_60187429 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

 <link rel="stylesheet" href="style/default/rucher.css">
 <?php echo '<script'; ?>
 src="script/ruche.js"><?php echo '</script'; ?>
>
 <link rel="stylesheet" href="style/default/rucher_rucher.css">
  </head>
<body>
    <h1 id="titre"> Gestion de la ruche</h1>
    <p>Rucher : <?php echo $_smarty_tpl->tpl_vars['NomRucher']->value;?>
</p>
	<p>Nom : <?php echo $_smarty_tpl->tpl_vars['NomRuche']->value;?>
</p>
	<p>Num&eacute;ro : <?php echo $_smarty_tpl->tpl_vars['NumRuche']->value;?>
</p>
	<p>Type de ruche : <?php echo $_smarty_tpl->tpl_vars['TypeRuche']->value;?>
</p>
    <p>Etat : <img src="images/<?php echo $_smarty_tpl->tpl_vars['EtatRuche']->value;?>
.png"></p>
    <div id="contenu_rucher">
      <p class="item">Informations</p>
	  <input type="hidden" name="id_ruche" value="0">
      <ul>
        <li>
		<form name="F_Essaim" action="voir_essaim.php" method="post">
		<input type="hidden" name="Id_Essaim" value="0">
          <div class="logo"><a href="#" onclick="ouvre_essaim(<?php echo $_smarty_tpl->tpl_vars['IdEssaim']->value;?>
)"><img src="images/<?php echo $_smarty_tpl->tpl_vars['ImageEssaim']->value;?>
.png"><?php echo $_smarty_tpl->tpl_vars['NomEssaim']->value;?>
</a></div>
		</form>
        </li>
        <li>
          <p><div class="logo"><a href="voir_info_ruche.php"><img src="images/information.png">Informations</a></div></p>
        </li>
        <li>
          <p><div class="logo"><a href="visite.php"><img src="images/visite.png">Visites</a></div></p>
        </li>
		</li>
        <li>
          <p><div class="logo"><a href="recolte.php"><img src="images/pot_miel.png">Récoltes</a></div></p>
        </li>
		</li>
        <li>
          <p><div class="logo"><a href="stat_ruche.php"><img src="images/stats.png">Stats</a></div></p>
        </li>
		<li>
          <p><div class="logo"><a href="aide.php?Id_Page=3" target="_blank"><img src="images/help.png">Aide</a></div></p>
        </li>
      </ul>
    </div>
	<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
 <?php }
}
