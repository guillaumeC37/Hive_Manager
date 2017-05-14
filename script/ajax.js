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
function Recupere_liste()  //Fonction non utilisée a terme
{
	var xhr=getXhr();
	//Definition de la fonction de réponse
	xhr.onreadystatechange=function()
	{
		if(xhr.readyState==4 && xhr.status==200)
		{
			//Fonction de traitement de l'information
			//On utilise xhr.responseText
			reponse=xhr.responseText;
			//On traduit le json
			tabRetour=JSON.parse(reponse);
			var i;
			var out="";
			for(i=0;i<tabRetour.length;i++)
			{
				out+="<p>"+tabRetour[i].nom+" => "+tabRetour[i].qte+"</p>";
			}
			//on affiche dans le document
			document.getElementById('listerucher').innerHTML=out;
		}
	}
	xhr.open("GET","testAjax.php",true); //on appelle la page avec la méthode post en asychrone
	xhr.send(null);
}
function ChercheRuche(objet)
{
	Id_Rucher=objet.value;
	leDiv=document.getElementById("listerucher");
	leDiv.style.visibility="hidden";
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
function ChargeRuche(objet)
{
	Id_Ruche=objet.value;
	leDiv=document.getElementById("listerucher");
	leDiv.style.visibility="hidden";
	if (Id_Ruche>0)
	{ //Si on a choisi un rucher
		var xhr=getXhr();
		xhr.onreadystatechange=function()
		{
			if(xhr.readyState==4 && xhr.status==200)
			{
				reponse=xhr.responseText;
				//On traduit le json
				tabRetour=JSON.parse(reponse);
				//Traitement de la réponse
				if (tabRetour[0].Nom===null)
				{
					LEssaim='aucun';
				}
				else
					LEssaim=tabRetour[0].Nom;
				out="<p><span class=\"infos\">Etat de la ruche</span> : "+tabRetour[0].Etat+"</p>";
				out+="<p><span class=\"infos\">Nombre de hausses</span> : "+tabRetour[0].NbreHausse+"</p>";
				out+="<p><span class=\"infos\">Essaim</span> : "+LEssaim+"</p>";
				leDiv.innerHTML=out;
				leDiv.style.visibility="visible";
				
			}
		}
		xhr.open("POST","ajax/ajax_ruche_etat.php",true); //on appelle la page avec la méthode post en asychrone
		xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		xhr.send("Id_Ruche="+Id_Ruche);  //ID post sera le $_POST[''] et ValuePost sa valeur	
	}
}