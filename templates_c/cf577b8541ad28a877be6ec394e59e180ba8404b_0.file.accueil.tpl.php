<?php
/* Smarty version 3.1.30, created on 2017-03-10 19:49:37
  from "C:\wamp\www\Gestion_Rucher\templates\accueil.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2f541873485_79783343',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf577b8541ad28a877be6ec394e59e180ba8404b' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\accueil.tpl',
      1 => 1488653084,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2f541873485_79783343 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="script/rucher.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="style/default/rucher.css">
</head>
 <body>
    <h1 id="titre">Assitant de gestion de rucher</h1>
	<div id="menu">
	<form name="loginform" action="index.php" method="post">
    <ul>
      <input type="hidden" name="logout" value="true">
	  <li><a href="#" onclick="submitlogin()">Logout</a></li>
    </ul>
	</form>
	</div>
	<div id="accueil_appi">
    Bonjour <?php echo $_smarty_tpl->tpl_vars['PrenomApiculteur']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['NomApiculteur']->value;?>
<br>
	</div>
	 <div id="contenu_Api">
      <p class="item">Ruchers</p>
	  <form name="visuRucher" method="post" action="voir_rucher.php">
	  <input type="hidden" name="id_rucher" value="0">
      <ul>
	    
	  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_rucher']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
	    <li>
            <p><div class="mage"> <a href="#" onclick="ouvre_rucher(<?php echo $_smarty_tpl->tpl_vars['infos']->value['ID_RUCHER'];?>
)"><img src="images/<?php echo $_smarty_tpl->tpl_vars['infos']->value['Image'];?>
.png"><?php echo $_smarty_tpl->tpl_vars['infos']->value['NOM_RUCHER'];?>
</a></div></p>
        </li>
	  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <li>
          <p><div class="mage"><a href="ajoutrucher.php"><img src="images/add_rucher.png">Ajouter un rucher</a></div></p>
        </li>
      </form>
      <hr>
      <p class="item">Divers</p>
      <ul>
        <li>
          <p><div class="mage"><a href="info_api.php"><img src="images/information.png">Informations</a></div></p>
        </li>
		<li>
          <p><div class="mage"><a href="parametres.php"><img src="images/parametre.png">Param&egrave;tres</a></div></p>
        </li>
        <li>
          <p><div class="mage"><a href="achat.php"><img src="images/achats.png">achats</a></div></p>
        </li>
        <li>
          <p><div class="mage"><a href="datalogger.php"><img src="images/sdcard.png">Datalogger</a></div></p>
        </li>
		<li>
          <p><div class="mage"><a href="stat_apiculteur.php"><img src="images/stats.png">Statistiques</a></div></p>
        </li>
		<li>
          <p><div class="logo"><a href="aide.php?Id_Page=1" target="_blank"><img src="images/help.png">Aide</a></div></p>
        </li>
      </ul>
    </div>
<?php }
}
