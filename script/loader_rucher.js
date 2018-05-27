//var MaRuche=new Ruche("ruche.png",0,0);
var ctx;
window.onload=function()
{
	var canvas=document.getElementById('canvas');
	 ctx=canvas.getContext('2d');
	//Chargement de la taille de l'image du rucher
	
	//
	var xhr=getXMLHttpRequest();
	xhr.open("GET","return_ruches.php",false);
	xhr.send(null);
	if(xhr.readyState != 4 || (xhr.status != 200 && xhr.status != 0)) // Code == 0 en local
		throw new Error("Impossible de charger la carte nommée carte (code HTTP : " + xhr.status + ").");
	var RuchesData = xhr.responseText;
	var tabruches=JSON.parse(RuchesData);
	var ImageRucher=tabruches.Rucher;
	var Mon_Rucher=new Rucher(ImageRucher);
	var ruches=tabruches.Ruches;
	//Ajouter les ruches au rucher
	var TabLength=ruches.length;
	for(i=0;i<TabLength;i++)
	{
		var TempRuche=new Ruche("ruche.png",ruches[i].X_Ruche,ruches[i].Y_Ruche,ruches[i].Z_Ruche);
		Mon_Rucher.addRuche(TempRuche);
	}
	//
	Mon_Rucher.dessinerRucher(ctx);	
	canvas.width=Mon_Rucher.GetWidth();
	canvas.height=Mon_Rucher.GetHeight();
	setInterval(function()
	{
		Mon_Rucher.dessinerRucher(ctx);
	},40);
}
function affiche_ruche()
{
	Mon_Rucher.addRuche(MaRuche);
}
function Sauvegarde()
{
	//Prépare la sauvegarde de l'image
	var MonImage=document.getElementById('canvas').toDataURL();
	var Formul=document.getElementById('monform');
	var InputImage=document.getElementById('Image_Ruche');
	InputImage.value=MonImage;
	//Mise en place des autres valeurs
	Formul.submit();
}
function getXMLHttpRequest() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}