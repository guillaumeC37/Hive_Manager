{include file="entete_carto_rucher.html"}
	<link rel="stylesheet" href="style/default/rucher.css">
	<link rel="stylesheet" href="style/default/carto.css">
	<script  src="script/classes/ruche.js"></script>
	<script  src="script/classes/rucher.js"></script>
	<script  src="script/loader_ruche.js"></script>
	</head>
<body>
   <header>
		<h1 id="titre"> Gestion du rucher - Cartographie ruche</h1>
		<p>Catographie du rucher : {$NOMRUCHER}</p>
		<p>Numéro du rucher : {$NUMRUCHER}</p>
		<p>Nom de la ruche : {$NOMRUCHE}</p>
		{if isset($Resultat)}
		<p><strong>{$Resultat}</strong></p>
		{/if}
		
	</header>
	<section id="cartoruche">
		<div id="leCanvas">
			<canvas id="canvas">Votre navigateur ne supporte pas le canvas</canvas>
			<p><input type="button" name="Btn_Save" id="Btn_Save" value="Sauvegarder" onclick="Saveruche()"></p>
		</div>
		<div id="LeTableau">
			<form name="monform" id="monform" method="post" action="">
				<table>
					<tr class="LigneTop">
						<td>
						</td>
						<td colspan="2">
							<p><input type="button" name="Btn_Haut" id="Btn_Haut" value="Haut" onclick="MoveUp()" class="Btn_Nav"></p>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							<p><input type="button" name="Btn_Gauche" id="Btn_Gauche" value="Gauche" onclick="MoveLeft()" class="Btn_Nav"></p>
						</td>
						<td>
							<p><input type="button" name="Btn_ZoomOut" id="Btn_ZoomOut" value="-" onclick="ZoomOut()" class="Btn_Nav"></p>
						</td>
						<td>
							<p><input type="button" name="Btn_ZoomIn" id="Btn_ZoomIn" value="+" onclick="ZoomIn()" class="Btn_Nav"></p>
						</td>
						<td>
							<p><input type="button" name="Btn_Droit" id="Btn_Droit" value="Droit" onclick="MoveRight()" class="Btn_Nav"></p>
						</td>
					</tr>
					<tr class="LigneBottom">
						<td>
						</td>
						<td colspan="2">
							<p><input type="button" name="Btn_Bas" id="Btn_Bas" value="Bas" onclick="MoveDown()"></p>
						</td>
						<td>
						</td>
					</tr>
				</table>		
				<input type="hidden" name="X_Ruche" value="{$XRUCHE}" id="X_Ruche">
				<input type="hidden" name="Y_Ruche" value="{$YRUCHE}" id="Y_Ruche">
				<input type="hidden" name="Zoom_Ruche" value="{$ZRUCHE}" id="Zoom_Ruche">
				<input type="hidden" name="Id_Ruche" value="{$ID_RUCHE}" id="Id_Ruche">
				<input type="hidden" name="Nom_Ruche" value="{$NOMRUCHE}" id="Nom_Ruche">
				<input type="hidden" name="CheminRucher" id="CheminRucher" value="{$CHEMIN_PHOTO}">
			</form>
		</div>
	</section>
	<p><a href="voir_ruche.php" id="LienRetour">Retour &agrave; la ruche</a></p>
