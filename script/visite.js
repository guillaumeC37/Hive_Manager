function ValideFormVisite()
{
	LaVisite=document.visite.dateVisite.value;
	var regex = /^[0-3][0-9]\/[0-9]{2}\/[0-9]{4}$/;
	test=regex.test(LaVisite);
	if (test)
	{
		document.visite.submit();
	}
	else
		alert('Veuillez remplir les champs obligatoires');
}
function ajoutemaladie()
{
	//On ajoute dans la liste déroulante la nouvelle maladie, avec un selected
	//Ensuite on change le input type hidden (A voir si on peut s'en passer)
	NewVal=-1;
	NomMaladie=document.getElementById("NouveauNom").value;
	if(NomMaladie!='')
	{
		var select = document.getElementById ("selectmaladie");
		var newOption = new Option (NomMaladie, NewVal,true);
		document.getElementById("MonBouton").disabled=true;
		document.getElementById("NouveauNom").disabled=true;
		select.options.add (newOption);
		document.getElementById("add_maladie").value=NomMaladie;
		document.getElementById("cbmaladie").checked=true;
	}
}
function afficheformul()
{
	bloc=document.getElementById('CacheMaladie');
	bloc.style.display='block';
}