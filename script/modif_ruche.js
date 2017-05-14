CompteModif=0;
MaDate="";
function Changer(Objet)
{
	Objet.style.background="#fd7d81";
	CompteModif++;
}
function verif_form()
{
	NomR=document.modif_ruche.NomRuche.value;
	NumRuche=document.modif_ruche.NumRuche.value;
	NbreHausse=document.modif_ruche.Hausses.value;
	NewDateRuche=document.modif_ruche.DateCrea.value;
	//Vérification du format de la date
	var regex = /^[0-3][0-9]\/[0-9]{2}\/[0-9]{4}$/;
	test=regex.test(NewDateRuche);
	if (!test)
	{
	   alert('format de la date non valide !');
	}
	else
	{
		if(NewDateRuche!=MaDate)
		{
		CompteModif++;
		}
		if (NbreHausse=="")
		{
			NbreHausse=0;
			document.modif_ruche.Hausses.value=0;
			alert('Nombre de hausse non valide');
		}	
		else
		{
			if((NomR!='')&(NumRuche!='')&(NbreHausse!='')&(CompteModif>0))
			{
				document.modif_ruche.submit();
			}
			else
				alert("Veuillez remplir tous les champs obligatoires ou aucun champ n'a été changé ");
		}
	}
}
function copieLaDate()
{
	MaDate=document.modif_ruche.DateCrea.value;
}