 {include file="entete_open.html"}
 <link rel="stylesheet" href="style/default/rucher.css">
 <script src="script/ruche.js"></script>
 <link rel="stylesheet" href="style/default/rucher_rucher.css">
  </head>
<body>
    <h1 id="titre"> Gestion de la ruche</h1>
    <p>Rucher : {$NomRucher}</p>
	<p>Nom : {$NomRuche}</p>
	<p>Num&eacute;ro : {$NumRuche}</p>
	<p>Type de ruche : {$TypeRuche}</p>
    <p>Etat : <img src="images/{$EtatRuche}.png"></p>
    <div id="contenu_rucher">
      <p class="item">Informations</p>
	  <input type="hidden" name="id_ruche" value="0">
      <ul>
        <li>
		<form name="F_Essaim" action="voir_essaim.php" method="post">
		<input type="hidden" name="Id_Essaim" value="0">
          <div class="logo"><a href="#" onclick="ouvre_essaim({$IdEssaim})"><img src="images/{$ImageEssaim}.png">{$NomEssaim}</a></div>
		</form>
        </li>
        <li>
          <p><div class="logo"><a href="voir_info_ruche.php"><img src="images/information.png">Informations</a></div></p>
        </li>
        <li>
          <p><div class="logo"><a href="visite.php"><img src="images/visite.png">Visites</a></div></p>
        </li>
		</li>
        <li>
          <p><div class="logo"><a href="recolte.php"><img src="images/pot_miel.png">Récoltes</a></div></p>
        </li>
		</li>
        <li>
          <p><div class="logo"><a href="stat_ruche.php"><img src="images/stats.png">Stats</a></div></p>
        </li>
		<li>
          <p><div class="logo"><a href="aide.php?Id_Page=3" target="_blank"><img src="images/help.png">Aide</a></div></p>
        </li>
      </ul>
    </div>
	<p><a href="voir_rucher.php" id="LienRetour">Retour au rucher</a></p>
 