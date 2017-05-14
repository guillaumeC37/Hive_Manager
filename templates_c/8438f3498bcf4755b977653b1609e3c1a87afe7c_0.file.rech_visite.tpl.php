<?php
/* Smarty version 3.1.30, created on 2017-03-11 13:07:06
  from "C:\wamp\www\Gestion_Rucher\templates\rech_visite.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3e86a1af9a2_04515036',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8438f3498bcf4755b977653b1609e3c1a87afe7c' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\rech_visite.tpl',
      1 => 1488225655,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c3e86a1af9a2_04515036 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
  <h1 id="titre">Suivi des visites</h1>
<p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Nom_Ruche']->value;?>
</p>
  <form method="POST" action="" name="VoirVisite">
  <input type="hidden" name="Rech_visite" value="1">
  <p>Recherche des visites :</p>
  	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
    <p><label for="DateDebut">Date de la plus ancienne : </label><input name="DateDebut" type="text" onclick="ds_sh(this);"></p>
		<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
<p><label for="DateFin">Date de la plus r&eacute;cente : </label><input name="DateFin" type="text" onclick="ds_sh(this);"></p>

<p>(Si les champs sont vides, toutes les visites seront affich&eacute;es, si une des dates n'est pas mentionn&eacute;e, alors ce sera la valeur par d&eacute;faut (la plus ancienne ou la plus nouvelle suivant le cas)</p>
    <input value="Rechercher" name="a" type="submit">
 
  </form>
  <p><a href="stat_ruche.php" id="LienRetour">Retour</a></p> 
<?php }
}
