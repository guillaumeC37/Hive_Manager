{include file="entete_open.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
<link rel="stylesheet" href="style/{$TemplateUser}/stat_data.css">
  </head>
<body>
 <h1 id="titre">Statistiques du datalogger</h1>
    <p>Relev&eacute;s du {$DateDebut} au {$DateFin}</p>
    <p>Ruche : {$Ruche}</p>
	<div id="statmoy">
	<h2>Valeurs moyennes des relev&eacute;s</h2>
	<p>Hygrométrie int&eacute;rieure : {$MoyHygroInt}%</p>
	<p>Hygrométrie ext&eacute;rieure : {$MoyHygroExt}%</p>
	<p>Température int&eacute;rieure : {$MoyTempInt}&deg;</p>
	<p>Température ext&eacute;rieure : {$MoyTempExt}&deg;</p>
	<p>Poids : {$MoyPoids} kg</p>
	</div>
    <p class="Titregraph">Relev&eacute; de poids</p>
    <p><img src="{$ImagePoids}" alt="releve poids"></p>
    <p class="Titregraph">Relev&eacute; de temp&eacute;ratures</p>
    <p><img src="{$ImageTemp}" alt="releve temperature"></p>
    <p class="Titregraph">Relev&eacute; hygrom&eacute;trique</p>
	<p><img src="{$ImageHygro}" alt="releve hygrometrie"></p>
<p><a href="stat_ruche.php"id="LienRetour">Retour &agrave; aux statistiques</a></p>