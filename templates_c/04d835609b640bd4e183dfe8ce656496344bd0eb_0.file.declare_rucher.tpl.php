<?php
/* Smarty version 3.1.30, created on 2017-03-11 10:47:05
  from "C:\wamp\www\Gestion_Rucher\templates\declare_rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c3c799de7414_62577129',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04d835609b640bd4e183dfe8ce656496344bd0eb' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\templates\\declare_rucher.tpl',
      1 => 1488225819,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c3c799de7414_62577129 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/declare_rucher.css">
  </head>
<body>
<h1 id="titre">D&eacute;claration du rucher</h1>
<p><span class="fixe">Nom :</span> <?php echo $_smarty_tpl->tpl_vars['NomApi']->value;?>
</p>
<p><span class="fixe">Prenom :</span> <?php echo $_smarty_tpl->tpl_vars['PrenomApi']->value;?>
</p>
<p><span class="fixe">Adresse :</span></p>
<p><?php echo $_smarty_tpl->tpl_vars['Adresse']->value;?>
</br>
<?php echo $_smarty_tpl->tpl_vars['Adresse2']->value;?>
</p>
<p><span class="fixe">NAPI :</span> <?php echo $_smarty_tpl->tpl_vars['NAPI']->value;?>
</p>
<p><span class="fixe">Siret :</span> <?php echo $_smarty_tpl->tpl_vars['SIRET']->value;?>
</p>
<p><span class="fixe">Num&eacute;ro de rucher :</span> <?php echo $_smarty_tpl->tpl_vars['NumRucher']->value;?>
</p>
<p><span class="fixe">Nom du rucher :</span> <?php echo $_smarty_tpl->tpl_vars['NomRucher']->value;?>
</p>
<p><span class="fixe">Localisation du rucher :</span> <?php echo $_smarty_tpl->tpl_vars['Localisation']->value;?>
</p>
<p><span class="fixe">Nombre de ruche :</span> <?php echo $_smarty_tpl->tpl_vars['Nbre_Ruche']->value;?>
</p>
<p><a href="documents/declare_rucherpdf.php" target="_blank"><img src="images/edit2.png" alt="Imprimer le document"></a></p>
<p><a href="edit_rucher.php" id="LienRetour">Retour aux &eacute;ditions rucher</a></p>
	<?php }
}
