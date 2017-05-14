<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:28:05
  from "C:\wamp\www\Gestion_Rucher\templates\add_rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3c325ec5f08_55944656',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8888026f38314535dbf4ee0bd3662d388959026a' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\add_rucher.tpl',
      1 => 1488220428,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3c325ec5f08_55944656 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="script/rucher.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="style/default/rucher.css">
</head>
  <body>
    <h1 id="titre">Ajouter un rucher</h1>
	<p>* : champs obligatoires</p>
	<form name="add_rucher" action="ajoutrucher.php" method="post">
    <p><input value="1" name="rucheractif" type="checkbox" checked>Rucher actif</p>
    <p><label for="nomRucher">Nom du rucher* :&nbsp;</label><input name="nomRucher" type="text" class="ChampsForm"></p>
    <p><label for="localisation">localisation* :&nbsp;</label><input name="localisation" type="text" class="ChampsForm"></p>
    <p><label for="coordonnees">Coordonnées GPS :&nbsp;</label><input name="coordonnees" type="text" class="ChampsForm"></p>
    <p><label for="Obs">Observations :&nbsp;</label><textarea name="Obs" class="ChampsForm"></textarea></p>
    <p><label for="numero">Numéro de rucher* :&nbsp;</label><input name="numero" type="text" class="ChampsForm"></p>
    <p class="pboutons_formulaires"><input  class="boutons_formulaires" value="Valider" name="Submit" type="button" onclick="SubmitRucher();"><input value="Annuler"class="boutons_formulaires" name="cancel" type="reset"></p>
	<input type="hidden" name="AjoutRucher" value="1">
	</form>
	<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p>
<?php }
}
