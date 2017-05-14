<?php
/* Smarty version 3.1.30, created on 2017-03-10 19:49:44
  from "C:\wamp\www\Gestion_Rucher\templates\info_api.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2f548a91a43_28363241',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0427bd0771baed8714d1b118be225ad2192e6437' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\info_api.tpl',
      1 => 1488221178,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c2f548a91a43_28363241 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/api.css">
<link rel="stylesheet" href="style/default/rucher.css">
 </head>
 <body>
    <h1 id="titre">Information sur l'apiculteur</h1>
	 <p>Nom : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['nom']->value;?>
</span></p>
    <p>Pr&eacute;nom : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['prenom']->value;?>
</span></p>
    <p>login : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['login']->value;?>
</span></p>
	<div id="adresseApi">
    <fieldset><legend>adresse : </legend>
    <p><?php echo $_smarty_tpl->tpl_vars['numero']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['typerue']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['nomrue']->value;?>
</p>
    <p><?php echo $_smarty_tpl->tpl_vars['cp']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['nomville']->value;?>
</p>
	</fieldset>
	</div>
	<p>adresse mail : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['adressemail']->value;?>
</span></p>
    <p>NUMAGRI : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['numagri']->value;?>
</span></p>
    <p>Code NAPI : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['napi']->value;?>
</span></p>
    <p>SIRET : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['siret']->value;?>
</span></p>
    <p>Code APE : <span class="info_api"><?php echo $_smarty_tpl->tpl_vars['ape']->value;?>
</span></p>
	<p><a href="update_api.php" id="ModifInfo_Api">Modifier les informations</a></p>
	<p><a href="index.php" id="LienRetour">Accueil</a></p>
<?php }
}
