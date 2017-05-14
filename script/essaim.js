function ControlIDEssaim(action)
{
	IDEssaim=document.aff_essaim.EssaimE.value;
	boite=document.aff_essaim.EssaimE;
	Choix=boite.selectedIndex;
	NomEssaim=boite.options[Choix].text;
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
function VerifForm()
{
	Nom=document.add_essaim.Nom_Essaim.value;
	DateM=document.add_essaim.DateC.value;
	//test format date essaim
	var regex = /^[0-3][0-9]\/[0-9]{2}\/[0-9]{4}$/;
	test=regex.test(DateM);
	if (!test)
	{
		alert('Format de date incorrect');
	}
	else
	{
		if ((Nom!="")&(DateM!="")&test)
		{
			document.add_essaim.submit();
		}
		else
			alert("Veuillez remplir les champs obligatoires");
	}	
}