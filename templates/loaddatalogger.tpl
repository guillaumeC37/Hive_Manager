{include file="entete_open.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
  </head>
<body>
<h1 id="titre">R&eacute;cup&eacute;ration des information d'un datalogger</h1>
  <p>Afin de pouvoir int&eacute;grer les informations de relev&eacute; d'un datalogger, il faut ins&eacute;rer la carte SD du datalogger dans votre PC, et le charger depuis cette page.</p>
<p>Les informations seront alors automatiquement int&eacute;gr&eacute;es au logiciel (1Mo maximum).</p>
<form method="POST" action="" name="gere_type" enctype="multipart/form-data">
  <input type="hidden" name="FileLoaded" value="1">
  <input name="MAX_FILE_SIZE" value="1048576" type="hidden">
  <input name="datalogger" type="file">
  <p><input value="Envoyer" name="Valide" type="submit"></p> 
  </form>
<p><a href="index.php"id="LienRetour">Retour &agrave; l'accueil</a></p>
