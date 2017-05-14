{include file="enteted.html"}  
<script src="script/essaimsupp.js"></script>
<link rel="stylesheet" href="style/default/voir_essaim.css">
<link rel="stylesheet" href="style/default/rucher.css">
 </head>
 <body>
    <h1 id="titre">Gestion des essaims</h1>
	<p>Ruche : {$Nom_RucheSel}</p>
	<p> Essaim actuel : {$NomEssaim}</p>
	<form name="aff_essaim"  method="post" action="affecte_essaim.php"> <!-- affecte_essaim -->
	<div id="affecte_field">
	<fieldset>
	<legend>R&eacute;affecter un essaim &agrave; la ruche</legend>
	<div id="liste_essaim" class="c1">
	<p>Liste des essaims existants et leur affectation</p>
	<p>Choisir l'essaim &agrave; r&eacute;affecter</p>
	<p><select name="EssaimE" multiple="multiple">
	{foreach from=$liste_essaims item=infos}
          <option value="{$infos.ID_E}">{$infos.NomE} - {$infos.NomR}</option>
		{/foreach}
    </select></p>
	<input type="hidden" name="reaffecte" value="2">
	<input type="hidden" name="NomEssaim" value="{$NomEssaim}">
	<p><input type="button" value="re affecter" onclick="ControlIDEssaim(2)"></p>
	</div>
	<div id="avertissement" class="c1">
	<p>Attention, une r&eacute;affectation d'un essaim supprime l'essaim existant dans la ruche actuelle, et vide la ruche pr&eacute;c&eacute;demment affect&eacute;e !</p>
	</div>
	</fieldset>
    </div>
	<div id="supp_essaim">
	<p><input type="button" value="Supprimer l'essaim" onclick="SuppEssaim(3)"></p>
	</div>
   </form>
	<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
