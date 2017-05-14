function changeTemplate(objet)
{
	ID=objet.value;
	imageSrc=document.getElementById("imgfond");
	Source="style/"+ID+"/"+ID+".png";
	imageSrc.src=Source;
	imageSrc.style.border="groove";
}