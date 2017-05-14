{include file="entete_open.html"}
 <script type="text/javascript" src="script/gest_miel.js"></script>
 <link rel="stylesheet" href="style/default/gest_miel.css">
 <link rel="stylesheet" href="style/default/rucher.css">
  </head>
<body>
  <h1 id="titre">Gestion des types de miel</h1>
<form method="POST" action="" name="gere_type" enctype="multipart/form-data">
  <input name="MAX_FILE_SIZE" value="4096" type="hidden">
   <input value="1" name="Modif_Form" type="hidden">
   <input type="hidden" id="MielSelected" name="Miel_Selected" value="-1">
  <p>Liste des types de miels existant dans la base (cliquez sur le type pour voir l'icone associ&eacute;e) :</p>
  <div id="ListeMiel">
  <ul>
{foreach from=$liste_miel item=infos}  
<li class="ligneMiel" onclick="affiche_photo('{$infos.Nom_Image}',{$infos.Id_Miel})">{$infos.Nom_Miel}</li>
{/foreach}
</ul>
</div>
<p id="photo_type">image associ&eacute;e : <img alt="icone" src="images/graph/noimage.png" id="icone_miel"></p>
<p><input value="1" name="ModifIcone" type="checkbox" onclick="VerifChecked(this)">Modifier l'icone du miel selectionn&eacute;</p>
<p>Icone (l'icone doit faire 20px*20px et 4Ko max au format png (jpeg non pris en compte pour le moment). Il sert pour identifier le type de miel dans les graphes) :
<br> <input name="Photo" type="file"></p>
<div id="champmiel">
<fieldset>
  <legend>Ajouter un type de miel.</legend>
<p>* champs obligatoires.</p>
  <p><label for="NomType">Nom *: </label><input name="NomType" id="NomType" type="text"></br>
  Pensez &agrave; choisir une icone pour le nouveau type !</p> 
   </fieldset>
</div>   
<p><input value="Valide" name="Valide" type="submit"></p> 
 </form>
<p><a href="parametres.php" id="LienRetour">Retour aux param&egrave;tres</a></p>
