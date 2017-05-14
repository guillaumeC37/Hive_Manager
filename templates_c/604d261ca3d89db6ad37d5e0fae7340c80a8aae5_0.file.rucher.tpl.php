<?php
/* Smarty version 3.1.30, created on 2017-03-10 23:13:05
  from "C:\wamp\www\Gestion_Rucher\aide\rucher.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58c324f12a9748_27127074',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '604d261ca3d89db6ad37d5e0fae7340c80a8aae5' => 
    array (
      0 => 'C:\\wamp\\www\\Gestion_Rucher\\aide\\rucher.tpl',
      1 => 1488230751,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:entete_open.html' => 1,
  ),
),false)) {
function content_58c324f12a9748_27127074 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:entete_open.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<link rel="stylesheet" href="style/<?php echo $_smarty_tpl->tpl_vars['TemplateUser']->value;?>
/rucher.css">
<link rel="stylesheet" href="aide/style/aide.css">
  </head>
<body>
    <h1 id="titre">Fiche aide : rucher</h1>
 <div class="paraf">
	<p>Dans cette page, vous trouverez tout ce qui concerne la gestion du
      rucher.</p>
</div>	  
    <h2>Les ruches :</h2>
 <div class="paraf"> 
 <p>Dans le cadre, en premier lieu, est affich&eacute; les ruches constituant
      le rucher.<br>
      Il suffit de cliquer sur une ruche pour y acc&eacute;der.</p>
    <p>En cliquant sur l'ajout d'une ruche, vous pouvez ajouter une ruche au
      rucher.</p>
	<p>Les icones suivantes repr&eacute;sentent :</p>
	<p><img src="aide/images/dadant_actif.png" alt="ruche active"> Une ruche active<br>
	<img src="aide/images/dadant_stock.png" alt="ruche stockee"> Une ruche re stock&eacute;e<br>
	<img src="aide/images/dadant_dead.png" alt="ruche morte"> Une ruche morte.</p>
	<p>Suivant le type de ruche d&eacute;fini dans la cr&eacute;ation d'une ruche, les icones seront modifi&eacute;es afin d'avoir un visuel distinctif pour chaque type de ruche.</p>
	<p><img src="aide/images/dadant_actif.png" alt="ruche dadant"> Une ruche dandant<br>
	<img src="aide/images/langstroth_actif.png" alt="ruche langstroth"> Une ruche Langstroth<br>
	<img src="aide/images/warre_actif.png" alt="ruche warre"> Une ruche Warr&eacute;<br>
	<img src="aide/images/ruchette_actif.png" alt="ruchette"> Une ruchette<br>
	<img src="aide/images/autre_actif.png" alt="ruche autre"> Une ruche non identifi&eacute;e</p>  
</div>	  
<h2>Informations</h2>
 <div class="paraf">	  
 <p class="imgpage"><img alt="Information rucher" src="aide/images/info_rucher.png"></p>
<p>Dans les informations, vous retrouverez les informations saisies lors de
      la cr&eacute;ation du rucher. Depuis cette page, vous pouvez modifier
      certains &eacute;l&eacute;ments.</p> 
</div>
<h2>Editions</h2>
 <div class="paraf">	  
  <p class="imgpage"><img alt="page editions" src="aide/images/edition_rucher.png"></p>
  <p> Sur la page &eacute;ditions, vous pouvez imprimer les diff&eacute;rents
    documents relatifs au rucher, ainsi que voir les statistiques globales de
    celui-ci.</p>
	 <h3>D&eacute;claration de rucher</h3>
	 <p>Imprime un document d'aide &agrave; la d&eacute;claration du rucher. Ce
    document n'est pas officiel, il faut se reporter au document CERFA
    indiqu&eacute; sur le page.</p>
	<h3>Statistiques du rucher</h3>
	<p>Affiche les statistiques du rucher</p>
</div>
	<p><a href="aide.php" id="LienRetour">Retour &agrave; l'aide</a></p>
<?php }
}
