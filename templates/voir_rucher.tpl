 {include file="entete_open.html"}
 <script src="script/rucher_ruche.js"></script>
 <link rel="stylesheet" href="style/default/rucher_rucher.css">
 <link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
    <h1 id="titre"> Gestion du rucher</h1>
    <p>Nom : {$NomRucher}</p>
	<p>Num&eacute;ro : {$NumRucher}</p>
    <p>Etat : <img src="images/{$EtatRucher}.png"></p>
    <div id="contenu_rucher">
      <p class="item">Ruches</p>
	  <form name="visuRuche" method="post" action="voir_ruche.php">
	  <input type="hidden" name="id_ruche" value="0">
      <ul>
	  {foreach from=$liste_ruche item=infos}
        <li>
          <span class="logo"><a href="#" onclick="ouvre_ruche({$infos.ID_R})"><img src="images/{$infos.Photo}.png">{$infos.Nom_R}</a></span>
        </li>
		{/foreach}
        <li>
          <p><span class="logo"><a href="ajout_ruche.php"><img src="images/ruche_add.png">Ajouter une ruche</a></span></p>
        </li>
      </ul>
	  </form>
      <hr>
      <p class="item">Divers</p>
      <ul>
        <li>
          <p><span class="logo"><a href="info_rucher.php"><img src="images/information.png">Informations</a></span></p>
        </li>
		<li>
          <p><span class="logo"><a href="edit_rucher.php"><img src="images/edit1.png">Editions</a></span></p>
        </li>
		<li>
          <p><span class="logo"><a href="aide.php?Id_Page=2" target="_blank"><img src="images/help.png">Aide</a></span></p>
        </li>
      </ul>
    </div>
	<p><a href="index.php" id="LienRetour">Retour &agrave; l'accueil</a></p>
 