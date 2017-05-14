{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/rucher.css">
<link rel="stylesheet" href="style/default/recolte_ruche.css">
  </head>
<body>
  <h1 id="titre">Resultats des recherches sur la r&eacute;colte</h1>
  <p>Ruche : {$Ruche}</p>
  <p>R&eacute;colte entre le {$DateDebut} et le {$DateFin} : </p>
<p>Poids total des r&eacute;coltes : {$Poids_total} Kg</p>
<p>Poids r&eacute;colt&eacute; par type de miel :</p>
{foreach from=$liste_recolte item=infos}
<p class="ListeMiel">{$infos.TypeMiel} : {$infos.Poids_Miel} Kg</p>
{/foreach}
<p>Graphique :</p>
 <p><img alt="graphique recolte" src="documents/{$graphique_recolte}"></p>
   <p><a href="stat_recolte.php" id="LienRetour">Retour</a></p> 
