{include file="entete_open.html"}
<script src="script/rucher.js"></script>
<link rel="stylesheet" href="style/default/rucher.css">
</head>
 <body>
    <h1 id="titre">Assitant de gestion de rucher</h1>
	<div id="menu">
	<form name="loginform" action="index.php" method="post">
    <ul>
      <input type="hidden" name="logout" value="true">
	  <li><a href="#" onclick="submitlogin()">Logout</a></li>
    </ul>
	</form>
	</div>
	<div id="accueil_appi">
    Bonjour {$PrenomApiculteur} {$NomApiculteur}<br>
	</div>
	 <div id="contenu_Api">
      <p class="item">Ruchers</p>
	  <form name="visuRucher" method="post" action="voir_rucher.php">
	  <input type="hidden" name="id_rucher" value="0">
      <ul>
	    
	  {foreach from=$liste_rucher item=infos}
	    <li>
            <p><div class="mage"> <a href="#" onclick="ouvre_rucher({$infos.ID_RUCHER})"><img src="images/{$infos.Image}.png">{$infos.NOM_RUCHER}</a></div></p>
        </li>
	  {/foreach}
        <li>
          <p><div class="mage"><a href="ajoutrucher.php"><img src="images/add_rucher.png">Ajouter un rucher</a></div></p>
        </li>
      </form>
      <hr>
      <p class="item">Divers</p>
      <ul>
        <li>
          <p><div class="mage"><a href="info_api.php"><img src="images/information.png">Informations</a></div></p>
        </li>
		<li>
          <p><div class="mage"><a href="parametres.php"><img src="images/parametre.png">Param&egrave;tres</a></div></p>
        </li>
        <li>
          <p><div class="mage"><a href="achat.php"><img src="images/achats.png">achats</a></div></p>
        </li>
        <li>
          <p><div class="mage"><a href="datalogger.php"><img src="images/sdcard.png">Datalogger</a></div></p>
        </li>
		<li>
          <p><div class="mage"><a href="stat_apiculteur.php"><img src="images/stats.png">Statistiques</a></div></p>
        </li>
		<li>
          <p><div class="logo"><a href="aide.php?Id_Page=1" target="_blank"><img src="images/help.png">Aide</a></div></p>
        </li>
      </ul>
    </div>
