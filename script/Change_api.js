function Submitchange()
{
   ok=false;
   reponse=document.add_appi.reponse.value;
   CP=document.add_appi.cp.value;
   Num=document.add_appi.adresse.value;
   Nom=document.add_appi.nomvoie.value;
   Ville=document.add_appi.ville.value;
   m1=document.add_appi.pass1.value;
   m2=document.add_appi.pass2.value;
   if((m1=='') ||(m1==m2))
   {
	   ok=true;
   }
   if (m1!=m2)
   {
	 document.add_appi.pass1.style.background="red";  
	 document.add_appi.pass2.style.background="red";
   }
   if(ok&&(reponse!='')&&(CP!='')&&(Num!='')&&(Nom!='')&&(Ville!=''))
   {
	   document.add_appi.submit();
   }
   else
   {
		alert('Veuillez remplir tous les champs obligatoires');
		if(reponse=='')
			document.add_appi.reponse.style.background="red";
		if(CP=='')
			document.add_appi.cp.style.background="red";
		if(Num=='')
			document.add_appi.nomvoie.style.background="red";
		if(Ville=='')
			document.add_appi.ville.style.background="red";
   }
}
function changevalue(objet)
{
	objet.style.background="green";
}