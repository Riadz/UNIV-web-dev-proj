function changeFrom(event){
	var tId = event.target.innerHTML;
	document.getElementById(tId).style.display="block";

	var ids = ["sports","joueurs","pratiques"];
	for(var i=0;i<ids.length;i++)
		if(ids[i]!=tId) document.getElementById(ids[i]).style.display="none";

	var btns = document.getElementsByClassName('changeBtn');
	for (var i=0;i<btns.length;i++) 
		btns[i].style.border="2px solid white";

	event.target.style.border="2px solid #3EC07E";

	document.getElementById("errorDiv").style.display = "none";
}

function validateSports(){
	if(document.forms["sports"]["Designation_Sport"].value.length > 25) 
		showErr("Designation du sport ne doit pas depase 25 charactaire");
	else return true;

	return false;
}

function validateJoueurs(){

	if(!document.forms["joueurs"]["Nom"].value.match(/^[A-Za-z]+$/)) 
		showErr("Nom ne doit pas contenier des nombre");
	else if(!document.forms["joueurs"]["Prenom"].value.match(/^[A-Za-z]+$/))
		showErr("Prenom ne doit pas contenier des nombre");
	else if(!document.forms["joueurs"]["Tel"].value.match(/^[0-9]+$/))
		showErr("numero de telephone ne doit pas contenir des lettre");
	else if(!document.forms["joueurs"]["Fax"].value.match(/^[0-9]+$/))
		showErr("numero de fax ne doit pas contenir des lettre");
	else if(!document.forms["joueurs"]["Email"].value.match(/@/))
		showErr("Email doit contenir @");
	else return true;

	return false;
}

function validatePratiques(){
	if(document.forms["pratiques"]["Date_Debut"].value>document.forms["pratiques"]["Date_Fin"].value)
		showErr("date de debut ne doit pas etre supperior a la date de fin");
	else return true;

	return false;
}

function showErr(string){
	document.getElementById("errorDiv").style.display = "block";
	document.getElementById("errorDiv").innerHTML = string;
}