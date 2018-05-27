var MaRuche;
var Mon_Rucher;
var ctx;
window.onload=function()
{
	var canvas=document.getElementById('canvas');
	 ctx=canvas.getContext('2d');
	//Chargement de la taille de l'image du rucher
	var X_LaRuche=document.getElementById('X_Ruche').value;
	var Y_LaRuche=document.getElementById('Y_Ruche').value;
	var Z_LaRuche=document.getElementById('Zoom_Ruche').value;
	var ImageRucher=document.getElementById('CheminRucher').value;
	Mon_Rucher=new Rucher(ImageRucher);
	MaRuche=new Ruche("ruche_carto.png",X_LaRuche,Y_LaRuche,Z_LaRuche);
	Mon_Rucher.addRuche(MaRuche);
	//
	Mon_Rucher.dessinerRucher(ctx);	
	canvas.width=Mon_Rucher.GetWidth();
	canvas.height=Mon_Rucher.GetHeight();
	setInterval(function()
	{
		Mon_Rucher.dessinerRucher(ctx);
	},40);
}
function Saveruche()
{
	//Prépare la sauvegarde de l'image
	var Formul=document.getElementById('monform');
	//Mise en place des autres valeurs
	var Mon_X=MaRuche.GetX();
	var Mon_Y=MaRuche.GetY();
	var Mon_Zoom=MaRuche.GetZoom();
	X_LaRuche=document.getElementById('X_Ruche').value=Mon_X;
	Y_LaRuche=document.getElementById('Y_Ruche').value=Mon_Y;
	Z_LaRuche=document.getElementById('Zoom_Ruche').value=Mon_Zoom;
	Formul.submit();
}
function MoveDown()
{
	MaRuche.Deplace(DIRECTION.BAS,Mon_Rucher,10);
}
function MoveUp()
{
	MaRuche.Deplace(DIRECTION.HAUT,Mon_Rucher,10);
}
function MoveRight()
{
	MaRuche.Deplace(DIRECTION.DROITE,Mon_Rucher,10);
}
function MoveLeft()
{
	MaRuche.Deplace(DIRECTION.GAUCHE,Mon_Rucher,10);
}
function ZoomIn()
{
	MaRuche.ZoomIn(ctx,2);
}
function ZoomOut()
{
	MaRuche.ZoomOut(ctx,2);
}