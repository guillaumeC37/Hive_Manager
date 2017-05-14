function verifForm()
{
	NomMaladie=document.getElementById('LeNom').value;
	if(NomMaladie=='')
	{
		alert("Veuillez saisir un nom !");
	}
	else
	{
		document.gere_type.submit();
	}
}