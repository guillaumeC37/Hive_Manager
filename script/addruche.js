function SubmitRuche()
{
   C1=document.add_ruche.nom.value;
   C2=document.add_ruche.num.value;
   LaDate=document.add_ruche.dateMES.value;
   var regex = /^[0-3][0-9]\/[0-9]{2}\/[0-9]{4}$/;
   test=regex.test(LaDate);
   if (!test)
   {
	   alert('format de la date non valide !');
   }
   else
   {
		if((C1!='' )&(C2!=''))
		{
			document.add_ruche.submit();
		}
		else
		{
			alert("Veuillez remplir tous les champs obligatoires");
		}
   }
}