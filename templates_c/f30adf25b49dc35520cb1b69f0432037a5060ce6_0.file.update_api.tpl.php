<?php
/* Smarty version 3.1.30, created on 2017-03-11 13:21:12
  from "C:\wamp\www\Gestion_Rucher\templates\update_api.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3ebb8dee866_63321373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f30adf25b49dc35520cb1b69f0432037a5060ce6' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\update_api.tpl',
      1 => 1488225466,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3ebb8dee866_63321373 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="script/Change_api.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="script/rucher.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="style/default/rucher.css">
</head>
<body>
    <h1 id="titre">Inscription d'un apiculteur</h1>
    <form name="add_appi" method="post" action="update_api.php">
      <p>* : champs obligatoires</p>
      <p>Nom : <?php echo $_smarty_tpl->tpl_vars['NomApi']->value;?>
</p>
	  <p>Pr&eacute;nom : <?php echo $_smarty_tpl->tpl_vars['PrenomApi']->value;?>
</p>
	  <p>Login : <?php echo $_smarty_tpl->tpl_vars['Login']->value;?>
</p>
	  <p>Laissez vide les mots de passe si vous ne souhaitez pas le changer</p>
	  <p><label for="pass1">mot de passe :&nbsp;</label><input name="pass1" class="ChampsForm" type="password" onchange="changevalue(this)">
      <p><label for="pass2">Confirmation :&nbsp;</label><input name="pass2" onkeyup="verifPass();" class="ChampsForm" type="password"><img src="" id="mdpOK"></p>
      <p><label for="adresse">Adresse* :&nbsp;</label><input name="adresse" size="4" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['NumRue']->value;?>
" onchange="changevalue(this)">&nbsp;
        <select name="voie" class="ChampsForm" onchange="changevalue(this)">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_voies']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['Id_Type'];?>
" <?php echo $_smarty_tpl->tpl_vars['infos']->value['selection'];?>
><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_Type'];?>
</option>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>&nbsp;<input name="nomvoie" size="50" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['NomRue']->value;?>
" onchange="changevalue(this)"></p>
      <p><input name="cp" size="6" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['CP']->value;?>
" onchange="changevalue(this)">&nbsp;<input name="ville" size="50" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['NomVille']->value;?>
" onchange="changevalue(this)"></p>
      <p><label for="siret">Siret :&nbsp;</label><input name="siret" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['SIRET']->value;?>
" onchange="changevalue(this)"></p>
      <p><label for="ape">Code APE :&nbsp;</label><input name="ape" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['APE']->value;?>
" onchange="changevalue(this)"></p>
      <label for="mail">Adresse mail :&nbsp;</label><input name="mail" class="ChampsForm" type="text" value="<?php echo $_smarty_tpl->tpl_vars['Ad_Mail']->value;?>
" onchange="changevalue(this)">
      <p>Veuillez de nouveau saisir :</p>
	  <p><label for="Listequestion">question secr&egrave;te (pour changer le mot de passe)* :</label>  <select name="Listequestion" class="ChampsForm" >
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['liste_question']->value, 'infos');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['infos']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['infos']->value['Id_Q'];?>
"><?php echo $_smarty_tpl->tpl_vars['infos']->value['Nom_Q'];?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

          </select> </p>
      <p><label for="reponse">R&eacute;ponse &agrave; la question* : </label><input name="reponse" type="text" class="ChampsForm"></p>
      <p>Attention, il n'y a pas d'autres moyen de r&eacute;cup&eacute;rer votre mot de passe que celui-ci. Conservez le et rappelez vous bien de votre r&eacute;ponse, en cas de souci</p>
      <input name="ChangeApi" value="true" type="hidden">
      <p class="pboutons_formulaires"><input class="boutons_formulaires" value="Valider" name="Submit" onclick="Submitchange();" type="button"><input value="Annuler" class="boutons_formulaires" name="cancel" type="reset"></p>
    </form>
    <p><a href="index.php" id="LienRetour">Retour index</a></p>
<?php }
}
