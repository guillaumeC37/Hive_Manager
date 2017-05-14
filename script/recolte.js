function ValideFormVisite()
{
	Date_R=document.recolte.dateRecolte.value;
	Poids=document.recolte.Poids.value;
	miel=document.recolte.Type_Miel.value;
	if ((Date_R!='')&(Poids!='')&(miel!=''))
	{
		document.recolte.submit();
	}
	else
		alert('Veuillez remplir les champs obligatoires');
}
function AjouteTypeMiel()
{
	//On ajoute dans la liste déroulante la nouvelle maladie, avec un selected
	//Ensuite on change le input type hidden (A voir si on peut s'en passer)
	NewVal=-1;
	NomMiel=document.getElementById("NouveauNom").value;
	if(NomMiel!='')
	{
		document.recolte.Temp_Miel.value=NomMiel;
		var select = document.getElementById ("selectmiel");
		var newOption = new Option (NomMiel, NewVal,true);
		document.getElementById("MonBouton").disabled=true;
		document.getElementById("NouveauNom").disabled=true;
		select.options.add (newOption);
	}
}
function afficheformul(objet)
{
	bloc=document.getElementById('CacheMiel');
	bloc.style.display='block';
	objet.style.display='none';
}