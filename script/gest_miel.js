function affiche_photo(NomPhoto, IdMiel)
{
	MonImage=document.getElementById('icone_miel');
	MonImage.setAttribute('src',NomPhoto);
	MonImage.style.border="solid red";
	LID=document.getElementById('MielSelected');
	LID.value=IdMiel;
}
function VerifChecked(Objet)
{
	//if coché, on bloque le nom
	//Sinon on débloque
	if (Objet.checked)
	{
		LeNom=document.getElementById('NomType');
		LeNom.value='';
		LeNom.disabled=true;
	}
	else
	{
		LeNom=document.getElementById('NomType');
		LeNom.disabled=false;
	}
}