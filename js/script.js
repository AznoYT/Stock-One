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
	else if(connect == 2) {
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
	popup.style.width = 'auto';
	popup.style.left = '12%';
	
	if(login == 1) { // Ici le Login
		// Ces conditions sont variante pour les chemins d'actions des formulaire si il y a un imprévue à la connexion
		popup.style.width = '42%';
		popup.style.left = '28.75%';
		
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
	}
	else if(login == 2) { // Ici le Register
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
	}
	
	popup.innerHTML = packet;
}

// Nouvelle fonction pour géré les popups d'actions du compte.
function popupaction(action, attempt, methode, nom, taille) {
	var popup = document.getElementById('popup');
	popup.style.width = 'auto';
	popup.style.left = '12%';
	
	if(action == 0) {
		packet = '';
		moreaction(0);
	}
	else if(action == 1) { // Ici l'upload
		popup.style.width = '30%';
		popup.style.left = '34.75%';
		
		if(attempt == 1) {
			packet = '<form method="post" action="./vupload.php" enctype="multipart/form-data">';
		}
		else {
			packet = '<form method="post" action="./pages/vupload.php" enctype="multipart/form-data">';
		}
		
		packet += '<fieldset>';
		
		if(methode == 0) {
			packet += '<legend>Envoyer un élément: [FICHIER]</legend>';
		}
		else if(methode == 1) {
			packet += '<legend>Envoyer un élément: [DOSSIER]</legend>';
		}
		
		packet += '<input type="button" onclick="popupaction(1, ' + attempt + ', 0);" value="Importer un fichier" id="file_choose" />';
		packet += '<input type="button" onclick="popupaction(1, ' + attempt + ', 1);" value="Importer un dossier" id="folder_choose" />';
		packet += '<br /><br />';
		
		if(methode == 0) { // Alternement en fichier
			packet += '<input type="file" name="fichiers" id="fichiers" title="Importation de fichiers" />';
		}
		else if(methode == 1) { // Alternement en dossier {PAS ENCORE TERMINER}
			packet += '<input type="file" name="dossier" id="dossier" title="Importation de dossiers" webkitdirectory />';
			packet += '<br />';
			packet += '<font id="msg1">/!\\ ATTENTION: Pas encore au point</font>';
		}
		
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
	}
	else if(action == 2) { // Ici la deconnexion
		popup.style.width = '30%';
		popup.style.left = '34.75%';
		
		packet = '<fieldset>';
		packet += '<legend>Déconnexion:</legend>';
		packet += '<label>Êtes-vous sûre de vouloir vous déconnecter ?</label>';
		packet += '<br /><br />';
		packet += '<input type="button" onclick="disconnect(1);" value="Oui" />';
		packet += ' - ';
		packet += '<input type="button" onclick="disconnect(0);" value="Non" />';
		packet += '</fieldset>';
	}
	else if(action == 3) { // Ici la création de répertoire
		popup.style.width = '30%';
		popup.style.left = '34.75%';
		
		packet = '<form method="post" action="./pages/vupload.php" enctype="multipart/form-data">';
		packet += '<fieldset>';
		packet += '<legend>Nouveau Dossier:</legend>';
		packet += '<label>Nom du dossier:</label>';
		packet += '<br />';
		packet += '<input type="text" name="Nom_Dossier" />';
		packet += '<br /><br />';
		packet += '<input type="checkbox" name="Public" value="notif">';
		packet += '<label>Publique</label>';
		packet += '<br /><br />';
		packet += '<input type="submit" name="option" value="Créer" />';
		
		if(attempt == 1) {
			packet += '<input type="button" onclick="document.location = \'../client.php\'" value="Retour" />';
		}
		else {
			packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />';
		}
		
		packet += '</fieldset>';
		packet += '</form>';
	}
	else if(action == 4) { // Ici l'affichage du fichiers
		packet = '<form method="post" action="./pages/action.php?fichiers=' + nom + '">';
		packet += '<fieldset>';
		packet += '<legend>Fichiers: ' + nom + ' - ' + taille + ' Bytes</legend>';
		packet += '<center>';
		
		if(methode == 0) { // Pour les dossiers
			packet += '<p>En construction</p>';
		}
		else if(methode == 1) { // Pour les images
			packet += '<img style="height: 500px;" title="' + nom + '" src="' + attempt + '" />';
		}
		else if(methode == 2) { // Pour les musiques
			packet += '<audio autoplay controls>';
			packet += '<source src="' + attempt + '" type="audio/mpeg" />';
			packet += '</audio>';
		}
		else if(methode == 3) { // Pour les fichiers textes ou pdf
			packet += '<div style="background-color: #FFFFFF; height: 500px;">';
			packet += '<iframe src="' + attempt + '"></iframe>';
			packet += '</div>';
		}
		else if(methode == 4) { // Pour les vidéos
			packet += '<video height="500px" autoplay controls>';
			packet += '<source src="' + attempt + '" type="audio/mpeg" />';
			packet += '</video>';
		}
		
		packet += '</center>';
		packet += '<br />';
		packet += '<input type="button" onclick="moreaction(1, \'' + nom + '\');" value="Copier" />';
		packet += '<input type="button" onclick="moreaction(2, \'' + nom + '\');" value="Déplacer" />';
		packet += '<input type="button" onclick="moreaction(3, \'' + nom + '\');" value="Supprimer" />';
		packet += ' - ';
		packet += '<a href="' + attempt + '" download><input type="button" value="Télécharger" /></a>';
		packet += '<input type="button" onclick="popupaction(0);" value="Fermer" />';
		packet += '</fieldset>';
		packet += '</form>';
	}
	
	popup.innerHTML = packet;
	moreaction(0);
}

// Cette fonction est dédié pour les commandes de copies déplacements et confirmation de suppresion
function moreaction(action, fichier) {
	var popup = document.getElementById('popupabout');
	
	if(action == 0) {
		packet = '';
	}
	else if(action == 1) { // Ici la copie
		packet = '<form method="post" action="./pages/action.php?fichiers=' + fichier + '">';
		packet += '<fieldset>';
		packet += '<legend>Copier un fichier:</legend>';
		packet += '<p>Copie de "' + fichier + '"</p>';
		packet += '<br />';
		packet += '<label>Vers:</label>';
		packet += '<br />';
		packet += '<input style="width: 98%;" type="text" name="to" value="./" />';
		packet += '<br /><br />';
		packet += '<input type="submit" name="action" value="Copier" />';
		packet += '<input type="button" onclick="moreaction(0);" value="Annuler" />';
		packet += '</fieldset>';
		packet += '</form>';
	}
	else if(action == 2) { // Ici le déplacement
		packet = '<form method="post" action="./pages/action.php?fichiers=' + fichier + '">';
		packet += '<fieldset>';
		packet += '<legend>Déplacer un fichier:</legend>';
		packet += '<p>Déplacement de "' + fichier + '"</p>';
		packet += '<br />';
		packet += '<label>Vers:</label>';
		packet += '<br />';
		packet += '<input style="width: 98%;" type="text" name="to" value="./" />';
		packet += '<br /><br />';
		packet += '<input type="submit" name="action" value="Déplacer" />';
		packet += '<input type="button" onclick="moreaction(0);" value="Annuler" />';
		packet += '</fieldset>';
		packet += '</form>';
	}
	else if(action == 3) { // Ici la confirmation de suppression
		packet = '<form method="post" action="./pages/action.php?fichiers=' + fichier + '">';
		packet += '<fieldset>';
		packet += '<legend>Supprimer un fichier:</legend>';
		packet += '<p>Êtes-vous sûre de vouloir supprimer "' + fichier + '" ?</p>';
		packet += '<br /><br />';
		packet += '<input type="submit" name="action" value="Oui" />';
		packet += ' - ';
		packet += '<input type="button" onclick="moreaction(0);" value="Non" />';
		packet += '</fieldset>';
		packet += '</form>';
	}
	
	popup.innerHTML = packet;
}

function adminswitch(mode) {
	setTimeout(function(){
		if(mode == 1) {
			document.location = "./admin.php";
		}
		else if(mode == 2) {
			document.location = "./client.php";
		}
	}, 350);
}

// Cette fonction est pour la deconnexion du compte
function disconnect(stat) {
	if(stat == 0) {
		popupaction(0);
	}
	else if(stat == 1) {
		document.location = "./pages/disconnect.php";
	}
}

// Fonction de développement /!\ PAS TOUCHER !!!!
function other(op) {
	if(op == 0) {
		document.location = "../client.php";
	}
	else if(op == 1) {
		document.location = "./pages/other.php";
	}
}

/******
* END *
******/

