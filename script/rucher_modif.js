function modifValeur(IDModif)
{
	Champ=eval("document.Modif_Rucher.C" + IDModif);
	Champ.value="1";
}
function ValideModif()
{
	V1=document.Modif_Rucher.C1.value;
	V2=document.Modif_Rucher.C2.value;
	V3=document.Modif_Rucher.C3.value;
	V4=document.Modif_Rucher.C4.value;
	V5=document.Modif_Rucher.C5.value;
	V6=document.Modif_Rucher.C6.value;
	if((V1==1)||(V2==1)||(V3==1)||(V4==1)||(V5==1)||(V6==1))
	{
		document.Modif_Rucher.submit();
	}
}