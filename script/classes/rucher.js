function Rucher(image_name)
{
	this.image=new Image();
	this.image.referenceDuRucher = this;
	this.image.onload=function()
	{
		if(!this.complete)
			throw new Error("Erreur de chargement du tileset nommé \""+url+"\".");
		this.referenceDuRucher.largeur=this.width;
	}
	this.image.src = image_name; //a changer dans le définitif
	this.width=this.image.width;
	this.heigth=this.image.height;
	this.ruches=new Array();
}

Rucher.prototype.dessinerRucher =function(context)
{
	context.drawImage(this.image,0,0);
	for (var i=0,l=this.ruches.length;i<l;i++)
	{
		this.ruches[i].dessinerRuche(context);
	}
}

Rucher.prototype.GetWidth =function()
{
	return this.image.width;
}

Rucher.prototype.GetHeight =function()
{
	return this.image.height;
}
Rucher.prototype.addRuche=function(LaRuche)
{
	this.ruches.push(LaRuche);
}