  {include file="entete_open.html"}
  <link rel="stylesheet" href="style/default/rucher.css">
  <script src="script/rucher.js"></script> 
  </head>
  <body{$Ajout}>
    <h1 id="titre"> Assistant de gestion de rucher</h1>
	<div id="menu">
      <form name="loginform" action="index.php" method="post">
	  <ul>
	  <li><input name="login" type="text" value="login" onclick="vide_champ(this)"><input name="pass" type="password"><a href="#" onclick="submitlogin()">Login</a></li>
      <li><a href="signIn.php">Sign In</a></li>
	  </ul>
	  </form>
	  <p id="mdp"><a href="mdp_oubli.php">mot de passe oubli&eacute;</a></p>
    </div>
    <div id="presentation"><p>Bienvenue dans {$NomLogiciel}, un logiciel permettant de g&eacute;rer
      votre activit&eacute; d'apiculture.</p>
    <p>Ce logiciel est un environnement multi-utilisateur, ce qui permet
      &agrave; plusieurs apiculteurs d'utiliser le m&ecirc;me syst&egrave;me
      sans pour autant que leurs informations soient connues des autres
      utilisateurs.</p>
    <p>Avec cette application, vous serez capable de g&eacute;rer vos ruchers,
      vos ruches, ainsi que d'autres caract&eacute;ristiques li&eacute;es
      &agrave; votre activit&eacute;.</p>
    <p>Le syst&egrave;me est compatible avec l'enregisteur de donn&eacute;es de
      ruches (en cours de d&eacute;veloppement) permettant un import direct des
      informations de vos ruches dans l'outil de travail, ce qui apporte une
      analyse des statistiques de l'exploitation.</p>
    <p>Une aide est pr&eacute;sente dans les diff&eacute;rentes pages afin de
      faciliter l'utilisation.</p></div>
	  <div>
	  <p>Ce site utilise des cookies pour fonctionner. Ces cookies sont &agrave; r&ocirc;le de gestion de sessions, et aucun cookies publicitaire ou autre n'est utilis&eacute;.<br>
	  En utilisant ce logiciel, vous acceptez de fait ces cookies.</p>
	  </div>

