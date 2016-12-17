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

// Cette fonction d'alert texte l'affiche mtn sur les 2 type de connexion Login & Register
// Le choix du mode se fait dans la variable "connect" de la fonction
function verify(connect, pws1, pws2) {
	var passed = false;
	var msg1 = document.getElementById('msg1');
	var msg2 = document.getElementById('msg2');
	
	if(connect == 1) {
		if(pws1.value =='') {
			msg1.innerHTML = ' <-- Ce champs est vide !';
			msg2.innerHTML = '';
			pws1.focus();
		}
		else if(pws2.value == '') {
			//alert("Veuillez entrer votre mot de passe dans le second champs.");
			msg1.innerHTML = '';
			msg2.innerHTML = ' <-- Ce champs est vide !';
			pws2.focus();
		}
		else {
			var passed = true;
		}
		return passed;
	}
	if(connect == 2) {
		if(pws1.value == '') {
			//alert("Veuillez entrer votre mot de passe dans le premier champs.");
			msg1.innerHTML = ' <-- Ce champs est vide !';
			msg2.innerHTML = '';
			pws1.focus();
		}
		else if(pws2.value == '') {
			//alert("Veuillez entrer votre mot de passe dans le second champs.");
			msg1.innerHTML = '';
			msg2.innerHTML = ' <-- Ce champs est vide !';
			pws2.focus();
		}
		else if(pws1.value != pws2.value) {
			//alert("Les 2 mot de passe ne correspondent pas.");
			msg1.innerHTML = ' <-- Les 2 champs sont différents !';
			msg2.innerHTML = ' <-- Les 2 champs sont différents !';
			pws1.select();
		}
		else {
			var passed = true;
		}
		return passed;
	}
}

// Nouvelle fonction pour géré les popup de login ou register de l'index
function popuplogin(login) {
	var popup = document.getElementById('popup');
	
	if(login == 1) {
		// Ici le Login
		popup.innerHTML = '<form method="post" action="./pages/veriflogin.php" onsubmit="return verify(1, this.lutilisateur, this.lpws);"><fieldset><legend>Connexion:</legend><label>Nom d\'Utilisateur:</label><br><input type="text" name="lutilisateur" ><font style="color: #FF0000;" id="msg1"></font><br><label>Mot de passe:</label><br><input type="password" name="lpws" ><font style="color: #FF0000;" id="msg2"></font><br><br><input type="submit" value="Connexion"><input type="button" onclick="popupaction(0);" value="Annuler" /></fieldset></form>';
	}
	if(login == 2) {
		// Ici le Register
		popup.innerHTML = '<form method="post" action="./pages/validate.php" onsubmit="return verify(2, this.pws, this.pws1);"><fieldset><legend>Inscription:</legend><label>Nom d\'utilisateur:</label><br><input type="text" name="utilisateur" value="" /><br><label>Nom:</label><br><input type="text" name="Nom" value="" /><br><label>Prénom:</label><br><input type="text" name="prenom" value="" /><br><br><label>Sexe:</label><br><input type="radio" name="genre" value="Homme" checked /> Homme<br><input type="radio" name="genre" value="Femme" /> Femme<br><input type="radio" name="genre" value="Autres" /> Autres<br><br><label>E-mail:</label><br><input type="email" name="email" /><br/><br/><label>Mot de passe:</label><br/><input type="password" name="pws" value="" /><font style="color: #FF0000;" id="msg1"></font><br><label>Confirmer votre Mot de Passe:</label><br><input type="password" name="pws1" value="" /><font style="color: #FF0000;" id="msg2"></font><br><br><input type="checkbox" name="notif" value="1" /> Souhaitez vous recevoir des notifications de la part de Stock-One<br><input type="checkbox" name="notifpart" value="1" /> Souhaitez vous que les Partenaires de Stock-One puisse vous Contacter<br><br><input type="submit" value="Envoyer" /><input type="reset" value="Tout Effacer" /><input type="button" onclick="popupaction(0);" value="Annuler" /></fieldset></form>';
	}
}

// Nouvelle fonction pour géré les popups d'actions du compte.
function popupaction(action) {
	var popup = document.getElementById('popup');
	
	if(action == 0) {
		popup.innerHTML = '';
	}
	if(action == 1) {
		// Ici l'upload
		popup.innerHTML = '<form method="post" action="./pages/vupload.php"><fieldset><legend>Envoyer un fichier:</legend><br><input name="file" type="file" /><br><br><input type="checkbox" name="Public" value="notif"><label>Publique</label><br/><br/><input type="submit" name="submit" value="Importer" /><input type="button" onclick="popupaction(0);" value="Annuler" /></fieldset></form';
	}
	if(action == 2) {
		// Ici le download
		popup.innerHTML = '<fieldset><legend>Recevoir un fichier:</legend><p>En Construction</p><br /><input type="button" onclick="popupaction(0);" value="OK" /></fieldset>';
	}
	if(action == 3) {
		// Ici la deconnexion
		popup.innerHTML = '<fieldset><legend>Déconnexion:</legend><label>Êtes-vous sûre de vouloir vous déconnecter ?</label><br /><br /><input type="button" onclick="disconnect(0);" value="Non" /><input type="button" onclick="disconnect(1);" value="Oui" /></fieldset>';
	}
}

function disconnect(stat) {
	if(stat == 0) {
		popupaction(0);
	}
	if(stat == 1) {
		document.location = "./pages/disconnect.php";
	}
}

// Cette fonction est temporaire, c'est pour le switch de page rapidement
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

