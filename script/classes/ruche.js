var DIRECTION=
{
	"BAS"		: 0,
	"GAUCHE"	: 1,
	"DROITE"	: 2,
	"HAUT"		: 3
}
function Ruche(url,x,y,z)
{
		this.x=parseInt(x);
		this.y=parseInt(y);
		this.Largeur=120;
		this.hauteur=105;
		if (typeof(z)=='undefined')
		{
			this.zoom=0;
		}
		else
		{
			this.zoom=parseInt(z);
		}
		//Ajout pour voir rucher
		if(this.zoom!=0)
		{
			//On test le niveau de zoom et on l'applique
			if(this.zoom<0) //Zoom out
			{
				step=Math.abs(this.zoom);
				this.Largeur=Math.round(this.Largeur/step);
				this.hauteur=Math.round(this.hauteur/step);
			}
			else
			{
				step=this.zoom;
				this.Largeur=Math.round(this.Largeur*step);
				this.hauteur=Math.round(this.hauteur*step);;
			}
			
		}
		//Fin ajout
		this.image=new Image();
		this.image.referenceRuche=this;
		this.image.onload=function()
		{
			if(!this.complete)
				throw "Erreur de chargement de la ruche";
			//this.referenceRuche.largeur=width;
			//this.referenceRuche.hauteur=height;
		}
		this.image.src="images/"+url; //a changer dans définitif
}
Ruche.prototype.dessinerRuche =function(context)
{
	//alert(this.Largeur+"x"+this.hauteur);
	context.drawImage(this.image,this.x,this.y,this.Largeur,this.hauteur);
}
Ruche.prototype.ZoomIn=function(context,step)
{
	//On redessine la ruche en fonction de critère zoom
	var OldX=this.x;
	var OldY=this.y;
	this.Largeur=Math.round(this.Largeur*step);
	this.hauteur=Math.round(this.hauteur*step);
	this.zoom=this.zoom+step;
	context.drawImage(this.image,OldX,OldY,this.Largeur,this.hauteur);
	
}
Ruche.prototype.ZoomOut=function(context,step)
{
	//On redessine la ruche en fonction de critère zoom
	var OldX=this.x;
	var OldY=this.y;
	this.Largeur=Math.round(this.Largeur/step);
	this.hauteur=Math.round(this.hauteur/step);
	this.zoom=this.zoom-step;
	context.drawImage(this.image,OldX,OldY,this.Largeur,this.hauteur);
}
Ruche.prototype.GetLargeur=function()
{
	return this.Largeur;
}
Ruche.prototype.GetHauteur=function()
{
	return this.hauteur;
}
Ruche.prototype.GetX=function()
{
	return this.x;
}
Ruche.prototype.GetY=function()
{
	return this.y;
}
Ruche.prototype.GetZoom=function()
{
	return this.zoom;
}
Ruche.prototype.Deplace=function(direction, rucher, step)
{
	//On récupère le "volume" de la ruche
	step=parseInt(step);
	var Prochain_X;
	var Prochain_Y;
	switch(direction)
	{
		case DIRECTION.HAUT :
			Prochain_X=this.x;
			Prochain_Y=this.y-step;
			break;
		case DIRECTION.BAS :
			Prochain_X=this.x;
			Prochain_Y=this.y+step;
			break;
		case DIRECTION.DROITE :
			Prochain_X=this.x+step;
			Prochain_Y=this.y;
			break;
		case DIRECTION.GAUCHE :
			Prochain_X=this.x-step;
			Prochain_Y=this.y;
			break;	
	}
	var PosDroit=Prochain_X+this.Largeur;
	var PosBas=Prochain_Y+this.hauteur;
	//alert('X= '+this.x+', Prochain='+Prochain_X+', Largeur : '+rucher.GetWidth());
	if((Prochain_X<0) ||(PosDroit)>rucher.GetWidth()||(Prochain_Y<0)||(PosBas)>rucher.GetHeight())
	{
		//alert('On depasse');
		return false;
	}
	this.x=Prochain_X;
	this.y=Prochain_Y;
	return true;
	//On deplace la ruche
}