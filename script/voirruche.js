var Etat=0;
var EtatE=0;
function voir_cache_div(Id)
{
	if(Etat==0)
	{
	  document.getElementById(Id).style.display="block";
	   Etat=1;
	  document.getElementById('imgfleche').src="images/haut.png";
	  document.getElementById('imgfleche2').src="images/haut.png";
	 
	}
	else
	{
		document.getElementById(Id).style.display="none";
		Etat=0;
		document.getElementById('imgfleche').src="images/bas.png";
        document.getElementById('imgfleche2').src="images/bas.png";		
	}
}
function voir_cache_Essaim(Id)
{
	if(EtatE==0)
	{
	  document.getElementById(Id).style.display="block";
	   EtatE=1;
	  document.getElementById('imgfleche3').src="images/haut.png";
	  document.getElementById('imgfleche4').src="images/haut.png";
	 
	}
	else
	{
		document.getElementById(Id).style.display="none";
		EtatE=0;
		document.getElementById('imgfleche3').src="images/bas.png";
        document.getElementById('imgfleche4').src="images/bas.png";		
	}
}