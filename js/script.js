/************************
*                       *
*    File: script.js    *
*                       *
************************/

var packet;

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
function verify(connect, pws1, pws2, usr) {
	var passed = false;
	var msg0 = document.getElementById('msg0');
	var msg1 = document.getElementById('msg1');
	var msg2 = document.getElementById('msg2');
	
	if(connect == 1) {
		if(pws1.value =='') {
			msg1.innerHTML = ' <-- Ce champs est vide !';
			msg2.innerHTML = '';
			pws1.focus();
		}
		else if(pws2.value == '') {
			msg1.innerHTML = '';
			msg2.innerHTML = ' <-- Ce champs est vide !';
			pws2.focus();
		}
		else if(pws1 == 1 && pws2 == 0) { // Cette condition c'est pour le mot de passe faux
			msg1.innerHTML = ' Nom d\'utilisateur ou mot de passe incorrect';
			msg2.innerHTML = '';
		}
		else {
			var passed = true;
		}
		return passed;
	}
	if(connect == 2) {
		if(usr.value == '') {
			msg0.innerHTML = ' <-- Ce champs est vide !';
			msg1.innerHTML = '';
			msg2.innerHTML = '';
			usr.focus();
		}
		else if(pws1.value == '') {
			msg0.innerHTML = '';
			msg1.innerHTML = ' <-- Ce champs est vide !';
			msg2.innerHTML = '';
			pws1.focus();
		}
		else if(pws2.value == '') {
			msg0.innerHTML = '';
			msg1.innerHTML = '';
			msg2.innerHTML = ' <-- Ce champs est vide !';
			pws2.focus();
		}
		else if(pws1.value != pws2.value) {
			msg0.innerHTML = '';
			msg1.innerHTML = ' <-- Les 2 champs sont différents !';
			msg2.innerHTML = ' <-- Les 2 champs sont différents !';
			pws1.select();
		}
		else if(pws1 == 1 && pws2 == 1 && usr == 0) { // Cette condition c'est pour le nom d'utilisateur déjà existant
			msg0.innerHTML = ' Nom d\'utilisateur déjà existant';
			msg1.innerHTML = '';
			msg2.innerHTML = '';
		}
		else {
			var passed = true;
		}
		return passed;
	}
}

// Nouvelle fonction pour géré les popup de login ou register de l'index
function popuplogin(login, attempt) {
	var popup = document.getElementById('popup');
	
	if(login == 1) {
		// Ici le Login
		// Ces conditions sont variante pour les chemins d'actions des formulaire si il y a un imprévue à la connexion
		if(attempt == 1) {
			packet = '<form method="post" action="./veriflogin.php" onsubmit="return verify(1, this.lutilisateur, this.lpws);">';
		}
		else {
			packet = '<form method="post" action="./pages/veriflogin.php" onsubmit="return verify(1, this.lutilisateur, this.lpws);">';
		}
		
		packet += '<fieldset>';
		packet += '<legend>Connexion:</legend>';
		packet += '<label>Nom d\'Utilisateur:</label>';
		packet += '<br />';
		packet += '<input type="text" name="lutilisateur" id="userinput" />';
		packet += '<font id="msg1"></font>';
		packet += '<br />';
		packet += '<label>Mot de passe:</label>';
		packet += '<br />';
		packet += '<input type="password" name="lpws" />';
		packet += '<font id="msg2"></font>';
		packet += '<br /><br />';
		packet += '<input type="submit" value="Connexion" />';
		
		if(attempt == 1) {
			packet += '<input type="button" onclick="document.location = \'../index.html\'" value="Retour" />';
		}
		else {
			packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />';
		}
		
		packet += '</fieldset>';
		packet += '</form>';
		
		popup.innerHTML = packet;
	}
	if(login == 2) {
		// Ici le Register
		// Même topo que pour le login
		if(attempt == 1) {
			packet = '<form method="post" action="./validate.php" onsubmit="return verify(2, this.pws, this.pws1, this.utilisateur);">';
		}
		else {
			packet = '<form method="post" action="./pages/validate.php" onsubmit="return verify(2, this.pws, this.pws1, this.utilisateur);">';
		}
		
		packet += '<fieldset>';
		packet += '<legend>Inscription:</legend>';
		packet += '<label>Nom d\'utilisateur:</label>';
		packet += '<br />';
		packet += '<input type="text" name="utilisateur" id="userinput" value="" />';
		packet += '<font id="msg0"></font>';
		packet += '<br />';
		packet += '<label>Nom:</label>';
		packet += '<br />';
		packet += '<input type="text" name="Nom" value="" />';
		packet += '<br />';
		packet += '<label>Prénom:</label>';
		packet += '<br />';
		packet += '<input type="text" name="prenom" value="" />';
		packet += '<br /><br />';
		packet += '<label>Sexe:</label>';
		packet += '<br />';
		packet += '<input type="radio" name="genre" value="Homme" checked /> Homme';
		packet += '<br />';
		packet += '<input type="radio" name="genre" value="Femme" /> Femme';
		packet += '<br />';
		packet += '<input type="radio" name="genre" value="Autres" /> Autres';
		packet += '<br /><br />';
		packet += '<label>E-mail:</label>';
		packet += '<br />';
		packet += '<input type="email" name="email" />';
		packet += '<br/><br/>';
		packet += '<label>Mot de passe:</label>';
		packet += '<br/>';
		packet += '<input type="password" name="pws" value="" />';
		packet += '<font id="msg1"></font>';
		packet += '<br />';
		packet += '<label>Confirmer votre Mot de Passe:</label>';
		packet += '<br />';
		packet += '<input type="password" name="pws1" value="" />';
		packet += '<font id="msg2"></font>';
		packet += '<br /><br />';
		packet += '<input type="checkbox" name="notif" value="1" /> Souhaitez vous recevoir des notifications de la part de Stock-One';
		packet += '<br />';
		packet += '<input type="checkbox" name="notifpart" value="1" /> Souhaitez vous que les Partenaires de Stock-One puisse vous Contacter';
		packet += '<br /><br />';
		packet += '<input type="submit" value="Envoyer" />';
		packet += '<input type="reset" value="Tout Effacer" />';
		
		if(attempt == 1) {
			packet += '<input type="button" onclick="document.location = \'../index.html\'" value="Retour" />';
		}
		else {
			packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />';
		}
		
		packet += '</fieldset>';
		packet += '</form>';
		
		popup.innerHTML = packet;
	}
}

// Nouvelle fonction pour géré les popups d'actions du compte.
function popupaction(action, attempt) {
	var popup = document.getElementById('popup');
	
	if(action == 0) {
		popup.innerHTML = '';
	}
	if(action == 1) {
		// Ici l'upload
		if(attempt == 1) {
			packet = '<form method="post" action="./vupload.php" enctype="multipart/form-data">';
		}
		else {
			packet = '<form method="post" action="./pages/vupload.php" enctype="multipart/form-data">';
		}
		
		packet += '<fieldset>';
		packet += '<legend>Envoyer un fichier:</legend>';
		packet += '<br />';
		packet += '<input type="file" name="fichiers" id="fichiers" />';
		packet += '<br /><br />';
		packet += '<input type="checkbox" name="Public" value="notif">';
		packet += '<label>Publique</label>';
		packet += '<br /><br />';
		packet += '<input type="submit" name="submit" value="Importer" />';
		
		if(attempt == 1) {
			packet += '<input type="button" onclick="document.location = \'../client.php\'" value="Retour" />';
		}
		else {
			packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />';
		}
		
		packet += '</fieldset>';
		packet += '</form>';
		
		popup.innerHTML = packet;
	}
	if(action == 2) {
		// Ici le download
		packet = '<fieldset>';
		packet += '<legend>Recevoir un fichier:</legend>';
		packet += '<p>En Construction</p>';
		packet += '<br />';
		packet += '<input type="button" onclick="popupaction(0);" value="OK" />';
		packet += '</fieldset>';
		
		popup.innerHTML = packet;
	}
	if(action == 3) {
		// Ici la deconnexion
		packet = '<fieldset>';
		packet += '<legend>Déconnexion:</legend>';
		packet += '<label>Êtes-vous sûre de vouloir vous déconnecter ?</label>';
		packet += '<br /><br />';
		packet += '<input type="button" onclick="disconnect(0);" value="Non" />';
		packet += '<input type="button" onclick="disconnect(1);" value="Oui" />';
		packet += '</fieldset>';
		
		popup.innerHTML = packet;
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

// Fonction de développement /!\ PAS TOUCHER !!!!
function other(op) {
	if(op == 0) {
		document.location = "../client.php";
	}
	if(op == 1) {
		document.location = "./pages/other.php";
	}
}

/******
* END *
******/

