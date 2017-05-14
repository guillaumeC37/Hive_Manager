<?php
/* Smarty version 3.1.30, created on 2017-03-10 18:52:01
  from "C:\wamp\www\Gestion_Rucher\templates\stat_ruche_rech_data.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c2e7c12d3bb5_02400160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '433a6f9c0cbe8cd2542f62e1dfb287cf48731684' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\stat_ruche_rech_data.tpl',
      1 => 1488910053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:enteted.html' => 1,
  ),
),false)) {
function content_58c2e7c12d3bb5_02400160 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:enteted.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 src="script/stat_verifdate.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
  <h1 id="titre">Statistiques du datalogger</h1>
<p>Ruche : <?php echo $_smarty_tpl->tpl_vars['Ruche']->value;?>
</p>
  <form method="POST" action="" name="VoirRecolte">
  <input type="hidden" name="Rech_data" value="1">
  <p>Date des relev&eacute;s :</p>
  	<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
    <p><label for="DateDebut">Date de la plus ancienne : </label><input name="DateDebut" id="DateDebut" type="text" onclick="ds_sh(this);"></p>
		<!-- Tableau obligatoire ! C'est lui qui contiendra le calendrier ! -->
		<table class="ds_box" cellpadding="0" cellspacing="0" id="ds_conclass" style="display: none;">
			<tr>
				<td id="ds_calclass"></td>
			</tr>
		</table>
<p><label for="DateFin">Date de la plus r&eacute;cente : </label><input name="DateFin" type="text" id="DateFin" onclick="ds_sh(this);"></p>

<p>(Si les champs sont vides, toutes les  donn&eacute;es seront affich&eacute;es, si une des dates n'est pas mentionn&eacute;e, alors ce sera la valeur par d&eacute;faut (la plus ancienne ou la plus nouvelle suivant le cas)</p>
    <input value="Rechercher" type="button" onclick="CompareDate()">
 
  </form>
  <p><a href="stat_ruche.php" id="LienRetour">Retour</a></p> 
<?php }
}
