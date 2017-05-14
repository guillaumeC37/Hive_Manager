{include file="entete_open.html"}
<link rel="stylesheet" href="style/default/gest_maladie.css">
<link rel="stylesheet" href="style/default/rucher.css">
<script src="script/gest_maladie.js"></script>
  </head>
<body>
 <h1 id="titre">Gestion des maladies</h1>
<form method="POST" action="" name="gere_type">
   <input value="1" name="Modif_Form" type="hidden">
  <p>Liste des maladies existantes dans la base :</p>
  <div id="ListeMaladie">
  <ul>
{foreach from=$liste_maladie item=infos}  
<li class="ligneMaladie">{$infos.Nom_Maladie}</li>
{/foreach}
</ul>
</div>
<div id="champ">
<fieldset>
  <legend>Ajouter une maladie.</legend>
<p>* champs obligatoires.</p>
  <p><label for="NomType">Nom *: </label><input name="NomMaladie" type="text" id="LeNom"></p> 
<p><input value="Valide" name="Valide" type="button" onclick="verifForm()"></p> 
</fieldset>
</div>
 </form>
<p><a href="parametres.php" id="LienRetour">Retour aux param&egrave;tres</a></p>
