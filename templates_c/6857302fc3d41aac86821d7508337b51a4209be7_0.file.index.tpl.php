<?php
/* Smarty version 3.1.30, created on 2017-03-10 23:20:00
  from "C:\wamp\www\Gestion_Rucher\aide\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c326907947b1_69954176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6857302fc3d41aac86821d7508337b51a4209be7' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\aide\\index.tpl',
      1 => 1489184170,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c326907947b1_69954176 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
<link rel="stylesheet" href="aide/style/aide.css">
  </head>
<body>
<h1 id="titre">Index de l'aide</h1>
<div id="Corps_Aide">	
	<ol>
		<div class="pageAide">
		<li><a href="aide.php?Id_Page=1">Fiche aide : Accueil</a>
			<ol>
				<li>Le Rucher
					<ol>
						<li>Visualiser l'&eacute;tat de chaque rucher en votre possession</li>
						<li>Ajouter un rucher</li>
					</ol>	
				</li>
				<li>Informations</li>
				<li>Param&egrave;tres
					<ol>
						<li>Liste des maladies</li>
						<li>Liste des types de miel</li>
						<li>Apparence</li>
					</ol>
				</li>
				<li>Achat</li>
				<li>Datalogger</li>
				<li>Statisitiques apiculteur</li>
			</ol>
		</li>
		</div>
		<div class="pageAide">
		<li><a href="aide.php?Id_Page=2">Fiche aide : rucher</a>
				<ol>
					<li>Les ruches</li>
					<li>Informations</li>
					<li>Editions
					<ol>
						<li>D&eacute;claration de rucher</li>
						<li>Statistiques du rucher</li>
					</ol>
				</ol>
		</li>
	</div>
	<div class="pageAide">
	<li><a href="aide.php?Id_Page=3">Fiche aide : Les ruches</a>
		<ol>
			<li>Les ruches</li>
			<li>La gestion des essaims
				<ol>
					<li>Affectation :</li>
					<li>Cr&eacute;ation d'un nouvel essaim :</li>
				</ol>
			</li>
			<li>Les informations</li>
			<li>Les visites</li>
			<li>Les r&eacute;coltes</li>
			<li>Les statistiques
				<ol>
					<li>Suivi des visites</li>
					<li>Graphiques de relev&eacute;s</li>
					<li>Bilan de la ruche</li>
				</ol>
			</li>
		</ol>
	</li>
	</div>
	<!--
	Autres <ol> ici en créant un nouveau div class pageAide
	<div class="pageAide">
	<li>Nouvelle page web
		<ol>
		<li>.......</li>
		</ol>
	</li>
	</div>
	-->
	</ol>
</div>	
<?php }
}
