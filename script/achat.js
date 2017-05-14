function ValideForm()
{
	LaDate=document.add_achat.DateAchat.value;
	LeMontant=document.add_achat.Montant.value;
	LeMag=document.add_achat.Magasin.value;
	LaDesc=document.add_achat.Desc.value;
	ok=false;
	//On vérifie si le montant est numérique
	if((isFlottant(LeMontant))||(isEntier(LeMontant)))
	{
		ok=true;
		//On vérifie si la date est bien formatée
		var regex = /^[0-3][0-9]\/[0-9]{2}\/[0-9]{4}$/;
		test=regex.test(LaDate);
		if(test)
		{
			if((LeMag!='')&&(LaDesc!=''))
			{
				document.add_achat.submit();
			}
			else
			{
				alert('Veuillez remplir tous les champs');
			}
		}
		else
		{
		alert('Date incorrecte !');
		}
	}
	else
	{
		ok=false;
		alert('Montant incorrect');
	}	
}
function isFlottant(valeur)
{
 p = /^([\d]+)(,|.)([\d]+)$/
 if(resultat = valeur.match(p))
 {
	return true;
 } 
 else
 {
	return false; 
 }
}
function isEntier(valeur)
{
 p = /^([\d]+)$/
 if(resultat = valeur.match(p))
 {
  return true;
 } 
 else
 {
	 return false;
 }
}
function VoirAchat(Objet)
{
	LaDiv=document.getElementById(Objet);
	LaDiv.style.display='block';
}