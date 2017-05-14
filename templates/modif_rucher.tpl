{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/infos.css">
<link rel="stylesheet" href="style/default/rucher.css">
<script src="script/rucher_modif.js"></script>
</head>
<body>
  <h1 id="titre">Informations rucher</h1>
  <p>Apiculteur : <span class="info_item">{$Nom_prenom}</span></p>
  <form name="Modif_Rucher" action="modif_rucher.php" method="post">
  <p><label for="NomR">Nom du rucher</label> : <input type="text" name="NomR" class="input_item" value="{$NomRucher}" onchange="modifValeur(1);"></p>
  <p><label for="NumR">Num&eacute;ro de rucher</label> : <input type="text" name="NumR" class="input_item" value="{$NumRucher}" onchange="modifValeur(2);"></p>
  <p><label for="Activ">Actif</label> : <input type="checkbox" name="Activ" {$Actif} onchange="modifValeur(3);"></p>
  <p><label for="LocR">localisation</label> : <input type="text" name="LocR" class="input_item" value="{$Loc}" onchange="modifValeur(4);"></p>
  <p><label for="CoordR">Coordonn&eacute;es GPS</label> :<input type="text" name="CoordR" class="input_item" value="{$GPS}" onchange="modifValeur(5);"></p>
  <input type="hidden" name="C1" value="0">
  <input type="hidden" name="C2" value="0">
  <input type="hidden" name="C3" value="0">
  <input type="hidden" name="C4" value="0">
  <input type="hidden" name="C5" value="0">
  <input type="hidden" name="C6" value="0">
  <input type="hidden" name="ModifFaite" value="1">
  <p>Observations :<br>
  <textarea name="observations" onchange="modifValeur(6);">{$Observations}</textarea></p>
  <p id="btn_validF"><input type="button" value="modification" onclick="ValideModif()"></p>
  <p><a href="info_rucher.php" id="LienRetour">Retour &agrave; la page info</a></p>
  </form>
