{include file="entete_open.html"}
<link rel="stylesheet" href="style/{$TemplateUser}/rucher.css">
<link rel="stylesheet" href="style/{$TemplateUser}/datalogger.css">
<script src="script/datalogger.js"></script>
  </head>
<body>
<h1 id="titre">Datalogger</h1>
<p>Le datalogger est un appareil &eacute;lectronique qui se place au niveau de la ruche et qui permet, gr&acirc;ce &agrave; des capteurs autour et dans la ruche de mesurer diff&eacute;rentes informations.</p>
<p>Vous devez indiquer la fr&eacute;quence de relev&eacute;, ainsi que les capteurs qui seront raccord&eacute;s. Il faut aussi indiquer la ruche sur laquelle il sera plac&eacute;.</p>
<p>En validant, vous aller t&eacute;l&eacute;charger un fichier qu'il suffit de placer sur une carte SD, qui sera mise en place dans le coffret &eacute;lectronique.</p>
<p><a href="loaddatalogger.php">Charger des donn&eacute;es d'un datalogger</a></p>
<p id="Soustitre">Configuration du datalogger</p>
<form name="datalogger" action="" method="post">
<input type="hidden" name="NewDTL" value="1">
 <p>Nombre d'enregistrement par jour :  <input type="text" size="2" readonly="readonly" name="NbreRec" id="ChampCompte" value="1"> <img src="images/add.png" alt="plus" onclick="add_field()"><img src="images/supp.png" alt="moins" onclick="supp_field()"></p>
<div id="ChampHeures">
 <p>Heure de relev&eacute; N&deg; 1 : 
<select name="Heure1">
  <option value="0">0</option>
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>  
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>  
  <option value="10">10</option>
  <option value="11">11</option>  
  <option value="12">12</option>  
  <option value="13">13</option>  
  <option value="14">14</option>
  <option value="15">15</option>  
  <option value="16">16</option>  
  <option value="17">17</option>  
  <option value="18">18</option>
  <option value="19">19</option>  
  <option value="20">20</option>  
  <option value="21">21</option>  
  <option value="22">22</option>  
  <option value="23">23</option>
    </select>&nbsp;h&nbsp;<select name="Minute1">
  <option value="00">00</option>
  <option value="05">05</option>
  <option value="10">10</option>
  <option value="15">15</option>
  <option value="20">20</option>
  <option value="25">25</option>
  <option value="30">30</option>
  <option value="35">35</option>
  <option value="40">40</option>
  <option value="45">45</option>
  <option value="50">50</option>
  <option value="55">55</option>  
    </select>  </p>
  </div>
  <p>Capteurs pr&eacute;sents :</p>
  <p><input name="TempExt" type="checkbox"> Temp&eacute;rature ext&eacute;rieure</p>
  <p><input name="TempInt" type="checkbox"> Temp&eacute;rature int&eacute;rieure</p>
  <p><input name="HygoExt" type="checkbox"> Hygrom&eacute;trie ext&eacute;rieure</p>
  <p><input name="HygroInt" type="checkbox"> Hygrom&eacute;trie ext&eacute;rieure</p>
  <p><input name="Poids" type="checkbox"> Poids</p>
<p>Affect&eacute; &agrave; la ruche : <select name="Rucher" onchange="ChercheRuche(this)">
<option value="-1" selected>--</option>
{foreach from=$ListeRucher item=infos}
<option value="{$infos.Id_Rucher}">{$infos.NomRucher}</option>
{/foreach}
</select> : <select name="LaRuche" id="SELECT_RUCHE">
<option value="-1" selected>--</option>
</select>
</p>
<p><input type="button" value="G&eacute;n&eacute;rer la configuration" onclick="ValidForm()"></p>
</form>
<p><a href="index.php" id="LienRetour">Retour</a></p>