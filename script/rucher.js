function submitlogin()
{
   document.loginform.submit();
}
function SubmitApi()
{
	
	pass1=document.add_appi.nom.value;
	pass2=document.add_appi.pass2.value;
	//verif des champs vides

	nom=document.add_appi.nom.value;
	Laquestion=document.add_appi.reponse.value;
	prenom=document.add_appi.prenom.value;
	login=document.add_appi.login.value;
	pass1=document.add_appi.pass1.value;
	adresse=document.add_appi.adresse.value;
	nomvoie=document.add_appi.nomvoie.value;
	cp=document.add_appi.cp.value;
	ville=document.add_appi.ville.value;
	numagrit=document.add_appi.numagrit.value;
	napi=document.add_appi.napi.value;

	if ((nom!='') &(prenom!='')&(login!='')&(pass1!='')&(adresse!='')&(nomvoie!='')&(cp!='')&(ville!='')&(numagrit!='')&(napi!='')&(Laquestion!=''))
	{
		if(pass1==pass2)
		{
		  document.add_appi.submit();
		}
		else
		{
			alert("Verifier le mot de passe");
		}
	}
	else
	{
		alert('Veuillez remplir les champs obligatoires');
	}
}
function verifPass()
{
	pass1=document.add_appi.pass1.value;
	pass2=document.add_appi.pass2.value;
	if (pass1==pass2)
	{
		document.add_appi.mdpOK.src="images/check.png";
	}
	else
	{
		document.add_appi.mdpOK.src="";
	}
}
function vide_champ(objet)
{
	objet.value='';
}
function SubmitRucher()
{
	LeNom=document.add_rucher.nomRucher.value;
    LaLoc=document.add_rucher.localisation.value;
    LeNum=document.add_rucher.numero.value;
	if((LeNom!='')&(LaLoc!='')&(LeNum!=''))
	{
		document.add_rucher.submit();
	}
	else
	{
		alert('Veuillez remplir les champs obligatoires');
	}
}
function ouvre_rucher(Id_Rucher)
{
	document.visuRucher.id_rucher.value=Id_Rucher;
	temp=document.visuRucher.id_rucher.value;
	document.visuRucher.submit();
}	