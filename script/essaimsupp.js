function ControlIDEssaim(action)
{
	IDEssaim=document.aff_essaim.EssaimE.value;
	boite=document.aff_essaim.EssaimE;
	Choix=boite.selectedIndex;
	NomEssaim=boite.options[Choix].text;
	document.aff_essaim.reaffecte.value=action;
	if (IDEssaim===null)
	{
	  alert("Choisir un essaim");
	}
	else
	{
		if(confirm("Voulez vous supprimer l'essaim actuel et re affecter l'essaim choisi  : "+NomEssaim+"?"))
		{
		  document.aff_essaim.submit();
		}
    }		
}
function SuppEssaim(action)
{
	document.aff_essaim.reaffecte.value=action;
	NomEssaim=document.aff_essaim.NomEssaim.value;
	if(confirm("Voulez vous supprimer l'essaim actuel : "+NomEssaim+" ?"))
	{
	  document.aff_essaim.submit();
	}
}