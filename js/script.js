/************************
*                       *
*    File: script.js    *
*                       *
************************/

function startTime() {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById('txt').innerHTML = h+ ":" + m + ":" + s;
	t = setTimeout(function(){ startTime() }, 500);
}

function checkTime(i) {
	if (i<10) {
		i = "0" + i;
	}
	return i;
}

function verify(pws1, pws2) {
	var passed = false;
	
	if(pws1.value == '') {
		alert("Veuillez entrer votre mot de passe dans le premier champs.");
		pws1.focus();
	}
	else if(pws2.value == '') {
		alert("Veuillez entrer votre mot de passe dans le second champs.");
		pws2.focus();
	}
	else if(pws1.value != pws2.value) {
		alert("Les 2 mot de passe ne correspondent pas.");
		pws1.select();
	}
	else {
		var passed = true;
	}
	return passed;
}

// Nouvelle fonction pour géré les popup de login ou register
function popuplogin(login) {
	var popup = document.getElementById('popup');
	
	if(login == 1) {
		// Ici le Login
		popup.innerHTML = '<form method="post" action="./pages/veriflogin.php"><fieldset><legend>Connexion:</legend><label>Nom d\'Utilisateur:</label><br><input type="text" name="lutilisateur" ><br><label>Mot de passe:</label><br><input type="password" name="lpws" ><br><br><input type="submit" value="Connexion"></fieldset></form>';
	}
	if(login == 2) {
		// Ici le Register
		popup.innerHTML = '<form method="post" action="./pages/validate.php" onsubmit="return verify(this.pws, this.pws1);"><fieldset><legend>Information Personnel:</legend><label>Nom d\'utilisateur:</label><br><input type="text" name="utilisateur" value="" /><br><label>Nom:</label><br><input type="text" name="Nom" value="" /><br><label>Prénom:</label><br><input type="text" name="prenom" value="" /><br><br><label>Sexe:</label><br><input type="radio" name="genre" value="Homme" checked /> Homme<br><input type="radio" name="genre" value="Femme" /> Femme<br><input type="radio" name="genre" value="Autres" /> Autres<br><br><label>E-mail:</label><br><input type="email" name="email" /><br/><br/><label>Mot de passe:</label><br/><input type="password" name="pws" value="" /><br><label>Confirmer votre Mot de Passe:</label><br><input type="password" name="pws1" value="" /><br><br><input type="checkbox" name="notif" value="1" /> Souhaitez vous recevoir des notifications de la part de Stock-One<br><input type="checkbox" name="notifpart" value="1" /> Souhaitez vous que les Partenaires de Stock-One puisse vous Contacter<br><br><input type="submit" value="Envoyer" /><input type="reset" value="Tout Effacer" /></fieldset></form>';
	}
}

// Nouvelle fonction pour géré les popups d'actions du compte.
function popupaction(action) {
	var popup = document.getElementById('popup');
	
	if(action == 1) {
		// Ici l'upload
		popup.innerHTML = '<form method="post" action="vupload.php"><fieldset><legend>Envoyer le fichier :</legend><br><input name="file" type="file" /><br><br><input type="checkbox" name="Public" value="notif"><label>Publique</label><br/><br/><input type="submit" name="submit" value="Uploader" /></fieldset></form';
	}
	if(action == 2) {
		// Ici le download
		popup.innerHTML = '';
	}
	if(action == 3) {
		// Ici la deconnexion
		popup.innerHTML = '';
	}
}

function dev(op) {
	if(op == 1) {
		document.location = "./index.html";
	}
	if(op == 2) {
		document.location = "./client.php";
	}
}

/******
* END *
******/

