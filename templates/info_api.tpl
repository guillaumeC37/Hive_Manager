{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/api.css">
<link rel="stylesheet" href="style/default/rucher.css">
 </head>
 <body>
    <h1 id="titre">Information sur l'apiculteur</h1>
	 <p>Nom : <span class="info_api">{$nom}</span></p>
    <p>Pr&eacute;nom : <span class="info_api">{$prenom}</span></p>
    <p>login : <span class="info_api">{$login}</span></p>
	<div id="adresseApi">
    <fieldset><legend>adresse : </legend>
    <p>{$numero} {$typerue} {$nomrue}</p>
    <p>{$cp} {$nomville}</p>
	</fieldset>
	</div>
	<p>adresse mail : <span class="info_api">{$adressemail}</span></p>
    <p>NUMAGRI : <span class="info_api">{$numagri}</span></p>
    <p>Code NAPI : <span class="info_api">{$napi}</span></p>
    <p>SIRET : <span class="info_api">{$siret}</span></p>
    <p>Code APE : <span class="info_api">{$ape}</span></p>
	<p><a href="update_api.php" id="ModifInfo_Api">Modifier les informations</a></p>
	<p><a href="index.php" id="LienRetour">Accueil</a></p>
