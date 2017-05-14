var LeDiv,LeChampElement,LeNouveauChampHeure,LeNouveauChampMinute,LeParaph;
var minute=["00","05","10","15","20","25","30","35","40","45","50","55"];
function add_field()
{
	LeChamp=document.getElementById('ChampCompte');
	ValeurChamp=LeChamp.value;
	if (ValeurChamp<6)
	{
		ValeurChamp++;
		//On ajoute un champ
		LeDiv=document.getElementById('ChampHeures');
		LeChampElement=LeDiv.getElementsByTagName('p'); //A changer par select
		LeNouveauChampHeure=document.createElement('select'); //a changer par select
		for(i=0;i<24;i++)
		{			
			var newOption = new Option (i, i,false);
			LeNouveauChampHeure.options.add(newOption);
		}
		LeNouveauChampHeure.setAttribute('type','text'); //A remplacer par création des options
		LeNouveauChampHeure.setAttribute('name','Heure'+ValeurChamp);
		//LeNouveauChamp.setAttribute('value','ch'+LeChampElement.length);
		LeParaph=document.createElement('p');
		var node=document.createTextNode('Heure de relevé N° '+ValeurChamp+' : ');
		LeParaph.appendChild(node);
		LeParaph.appendChild(LeNouveauChampHeure);
		var node2=document.createTextNode(' h ');	
		LeParaph.appendChild(node2);	
		LeNouveauChampMinute=document.createElement('select');
		for(var i = 0;i < minute.length; i++)
		{
			var newOption = new Option (minute[i], minute[i],false);
			LeNouveauChampMinute.options.add(newOption);
		}
		LeNouveauChampMinute.setAttribute('name','Minute'+ValeurChamp);
		LeParaph.appendChild(LeNouveauChampMinute);
		LeDiv.appendChild(LeParaph);
	}
	LeChamp.value=ValeurChamp;
}
function supp_field()
{
	LeChamp=document.getElementById('ChampCompte');
	ValeurChamp=LeChamp.value;
	if(ValeurChamp>1)
	{
	  ValeurChamp--;
	  //On supprime le dernier champ
	  if(LeChampElement.length>1)
	  {
		 LeDiv.removeChild(LeChampElement[LeChampElement.length-1]);
	  }
	}
	LeChamp.value=ValeurChamp;
}
function getXhr()
{
	var xhr = null; 
	if(window.XMLHttpRequest) // Firefox et autres
	   xhr = new XMLHttpRequest(); 
	else if(window.ActiveXObject){ // Internet Explorer 
	   try {
                xhr = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }
	}
	else { // XMLHttpRequest non supporté par le navigateur 
	   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	   xhr = false; 
	}
	return xhr;
}
function ChercheRuche(objet)
{
	Id_Rucher=objet.value;
	if (Id_Rucher>0)
	{ //Si on a choisi un rucher
		//On vide le select, sauf N°1
		SelectRuche=document.getElementById("SELECT_RUCHE");
		OptionRuche=SelectRuche.getElementsByTagName('option');
		while(OptionRuche[1])
		{
			SelectRuche.removeChild(OptionRuche[1]);
		}
		var xhr=getXhr();
		xhr.onreadystatechange=function()
		{
			if(xhr.readyState==4 && xhr.status==200)
			{
				//Fonction de traitement de l'information
				//On utilise xhr.responseText
				reponse=xhr.responseText;
				//alert(reponse);
				//On traduit le json
				tabRetour=JSON.parse(reponse);																		
				for(i=0;i<tabRetour.length;i++)
				{
					var newOption = new Option (tabRetour[i].nom, tabRetour[i].id,true);
					document.getElementById("SELECT_RUCHE").options.add (newOption);
				}
				document.getElementById("SELECT_RUCHE").options[0].selected=true;
			}
		}
		xhr.open("POST","ajax/ajax_ruche.php",true); //on appelle la page avec la méthode post en asychrone
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xhr.send("Id_Rucher="+Id_Rucher);  //ID post sera le $_POST[''] et ValuePost sa valeur	
	}	
}
function ValidForm()
{
	document.datalogger.submit();
}
