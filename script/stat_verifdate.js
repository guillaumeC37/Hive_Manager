function CompareDate()
{
	Date1=document.getElementById("DateDebut").value;
	Date2=document.getElementById("DateFin").value;
	if(Date1=='')
	{
		D1=new Date('2015-01-01');
	}
	else
	{
		DateD=Date1.split('/');
		Fdate1=DateD[2]+'-'+DateD[1]+'-'+DateD[0];
		D1=new Date(Fdate1);
	}
	if(Date2=='')
	{
		D2=new Date();
	}
	else
	{
		DateF=Date2.split('/');
		Fdate2=DateF[2]+'-'+DateF[1]+'-'+DateF[0];
		D2=new Date(Fdate2);
	}
	Delta=D2-D1;
	if(Delta<=0)
	{
		alert('Attention, la date de debut est superieure a la date de fin');
	}
	else
		document.VoirRecolte.submit();
	
}