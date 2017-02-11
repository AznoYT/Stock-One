/************************
*                       *
*    File: script.js    *
*                       *
************************/

var packet;
var packet0;
var a = 0;

function startTime() {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
	t = setTimeout(function() { startTime(); }, 500);
	if(a <= 3) { a = Note_annim(a); }
	//hide_pubs();
}

function checkTime(i) {
	if (i<10) { i = "0" + i; }
	return i;
}

// Ajout d'information de note
function Note_annim(i) {
	var output = document.getElementById('Note_MAJ');
	
	if(output != undefined) {
		var msg = [document.getElementById('text_0').value, document.getElementById('text_1').value, document.getElementById('text_2').value, document.getElementById('text_3').value];
		
		switch(i) {
			case 0: packet0 = msg[i]; break;
			case 1: packet0 += msg[i]; break;
			case 2: packet0 += msg[i]; break;
			case 3: packet0 += msg[i]; break;
		}
		
		output.innerHTML = packet0;
		i++;
		return i;
	}
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
		else if(usr == "confirm" && pws1.value != pws2.value) {
			msg1.innerHTML = ' <-- Les 2 champs sont différents !';
			msg2.innerHTML = ' <-- Les 2 champs sont différents !';
			pws1.focus();
		}
		else if(pws1 == 1 && pws2 == 0) { // Cette condition c'est pour le mot de passe faux
			msg1.innerHTML = ' Nom d\'utilisateur ou mot de passe incorrect';
			msg2.innerHTML = '';
		}
		else { var passed = true; }
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
			pws1.focus();
		}
		else if(pws1 == 1 && pws2 == 1 && usr == 0) { // Cette condition c'est pour le nom d'utilisateur déjà existant
			msg0.innerHTML = ' Nom d\'utilisateur déjà existant';
			msg1.innerHTML = '';
			msg2.innerHTML = '';
		}
		else { var passed = true; }
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
		
		switch(attempt) {
			case 1: packet = '<form method="post" action="./validate.php" onsubmit="return verify(1, this.lutilisateur, this.lpws);">'; break;
			default: packet = '<form method="post" action="./pages/validate.php" onsubmit="return verify(1, this.lutilisateur, this.lpws);">'; break;
		}
		
		packet += '<fieldset>';
		packet += '<legend>Connexion:</legend>';
		packet += '<input type="hidden" name="method" value="LOGIN" />';
		packet += '<label for="userinput">Nom d\'Utilisateur:</label>';
		packet += '<br />';
		packet += '<input type="text" name="lutilisateur" id="userinput" />';
		packet += '<font id="msg1"></font>';
		packet += '<br />';
		packet += '<label for="password">Mot de passe:</label>';
		packet += '<br />';
		packet += '<input type="password" id="password" name="lpws" />';
		packet += '<font id="msg2"></font>';
		packet += '<br /><br />';
		packet += '<input class="ACT" type="submit" value="Connexion" />';
	}
	else if(login == 2) { // Ici le Register
		// Même topo que pour le login
		switch(attempt) {
			case 1: packet = '<form method="post" action="./validate.php" onsubmit="return verify(2, this.pws, this.pws1, this.utilisateur);">'; break;
			default: packet = '<form method="post" action="./pages/validate.php" onsubmit="return verify(2, this.pws, this.pws1, this.utilisateur);">'; break;
		}
		
		packet += '<fieldset>';
		packet += '<legend>Inscription:</legend>';
		packet += '<input type="hidden" name="method" value="REGISTER" />';
		packet += '<label for="userinput">Nom d\'utilisateur:*</label>';
		packet += '<br />';
		packet += '<input type="text" name="utilisateur" id="userinput" value="" />';
		packet += '<font id="msg0"></font>';
		packet += '<br />';
		packet += '<label for="nom">Nom:</label>';
		packet += '<br />';
		packet += '<input type="text" id="nom" name="Nom" value="" />';
		packet += '<br />';
		packet += '<label for="surnom">Prénom:</label>';
		packet += '<br />';
		packet += '<input type="text" id="surnom" name="prenom" value="" />';
		packet += '<br /><br />';
		packet += '<label>Sexe:</label>';
		packet += '<br />';
		packet += '<input type="radio" id="Homme" name="genre" value="Homme" checked />';
		packet += '<label for="Homme"> Homme</label>';
		packet += '<br />';
		packet += '<input type="radio" id="Femme" name="genre" value="Femme" />';
		packet += '<label for="Femme"> Femme</label>';
		packet += '<br />';
		packet += '<input type="radio" id="Autres" name="genre" value="Autres" />';
		packet += '<label for="Autres"> Autres</label>';
		packet += '<br /><br />';
		packet += '<label for="adresse">E-mail:</label>';
		packet += '<br />';
		packet += '<input type="email" id="adresse" name="email" />';
		packet += '<br />';
		packet += '<label for="password">Mot de passe:*</label>';
		packet += '<br />';
		packet += '<input id="password" type="password" name="pws" value="" />';
		packet += '<font id="msg1"></font>';
		packet += '<br />';
		packet += '<label for="confirmpassword">Confirmer votre Mot de Passe:*</label>';
		packet += '<br />';
		packet += '<input id="confirmpassword" type="password" name="pws1" value="" />';
		packet += '<font id="msg2"></font>';
		packet += '<br /><br />';
		packet += '<input type="checkbox" id="notif" name="notif" value="1" />';
		packet += '<label for="notif"> Souhaitez vous recevoir des notifications de la part de Stock-One</label>';
		packet += '<br />';
		packet += '<input type="checkbox" id="notifpart" name="notifpart" value="1" />';
		packet += '<label for="notifpart"> Souhaitez vous que les Partenaires de Stock-One puisse vous Contacter</label>';
		packet += '<br /><br />';
		packet += '<input class="ACT" type="submit" value="Inscription" />';
		packet += '<input class="WARN" type="reset" value="Tout Effacer" />';
	}
	
	switch(attempt) {
		case 1: packet += '<input type="button" onclick="document.location = \'../index.html\'" value="Retour" />'; break;
		default: packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />'; break;
	}
		
	packet += '</fieldset>';
	packet += '</form>';
	
	popup.innerHTML = packet;
	document.getElementById('userinput').focus();
}

// Nouvelle fonction pour géré les popups d'actions du compte.
function popupaction(action, attempt, methode, nom, taille) {
	var popup = document.getElementById('popup');
	
	if(action == 0) {
		packet = '';
		moreaction(0);
	}
	else if(action == 1) { // Ici l'upload
		popup.style.width = '30%';
		popup.style.left = '34.75%';
		moreaction(0);
		
		switch(attempt) {
			case 1: packet = '<form method="post" action="./vupload.php" enctype="multipart/form-data">'; break;
			default: packet = '<form method="post" action="./pages/vupload.php" enctype="multipart/form-data">'; break;
		}
		
		packet += '<fieldset>';
		
		switch(methode) {
			case 0: packet += '<legend>Envoyer un élément: [FICHIER]</legend>'; break;
			case 1: packet += '<legend>Envoyer un élément: [DOSSIER]</legend>'; break;
		}
		
		packet += '<input type="button" onclick="popupaction(1, ' + attempt + ', 0);" value="Importer un fichier" id="file_choose" />';
		packet += '<input type="button" onclick="popupaction(1, ' + attempt + ', 1);" value="Importer un dossier" id="folder_choose" />';
		packet += '<br /><br />';
		
		switch(methode) {
			case 0: packet += '<input type="file" name="fichiers" id="fichiers" title="Importation de fichiers" required />'; break;
			case 1: packet += '<input type="file" name="dossier" id="dossier" title="Importation de dossiers" webkitdirectory required />';
				packet += '<br />';
				packet += '<font id="msg1">/!\\ ATTENTION: Incompatible sous Mozilla FireFox</font>';
				break;
		}
		
		packet += '<br /><br />';
		packet += '<input type="checkbox" id="public" name="Public" value="notif">';
		packet += '<label for="public"> Publique</label>';
		packet += '<br /><br />';
		packet += '<input class="ACT" type="submit" name="submit" value="Importer" />';
		
		switch(attempt) {
			case 1: packet += '<input type="button" onclick="document.location = \'../client.php\'" value="Retour" />'; break;
			default: packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />'; break;
		}
		
		packet += '</fieldset>';
		packet += '</form>';
	}
	else if(action == 2) { // Ici la deconnexion
		popup.style.width = '30%';
		popup.style.left = '34.75%';
		moreaction(0);
		
		packet = '<fieldset>';
		packet += '<legend>Déconnexion:</legend>';
		packet += '<label>Êtes-vous sûre de vouloir vous déconnecter ?</label>';
		packet += '<br /><br />';
		
		switch(attempt) {
			case 1: packet += '<input class="WARN" type="button" onclick="disconnect(1, 1);" value="Oui" />'; break;
			default: packet += '<input class="WARN" type="button" onclick="disconnect(1, 0);" value="Oui" />'; break;
		}
		
		packet += ' - ';
		packet += '<input type="button" onclick="disconnect(0, 0);" value="Non" />';
		packet += '</fieldset>';
	}
	else if(action == 3) { // Ici la création de répertoire
		popup.style.width = '30%';
		popup.style.left = '34.75%';
		moreaction(0);
		
		packet = '<form method="post" action="./pages/vupload.php" enctype="multipart/form-data">';
		packet += '<fieldset>';
		packet += '<legend>Nouveau Dossier:</legend>';
		packet += '<label>Nom du dossier:</label>';
		packet += '<br />';
		packet += '<input type="text" id="nom_dossier" name="Nom_Dossier" />';
		packet += '<br /><br />';
		packet += '<input type="checkbox" id="public" name="Public" value="notif">';
		packet += '<label for="public"> Publique</label>';
		packet += '<br /><br />';
		packet += '<input class="ACT" type="submit" name="option" value="Créer" />';
		
		switch(attempt) {
			case 1: packet += '<input type="button" onclick="document.location = \'../client.php\'" value="Retour" />'; break;
			default: packet += '<input type="button" onclick="popupaction(0);" value="Annuler" />'; break;
		}
		
		packet += '</fieldset>';
		packet += '</form>';
	}
	else if(action == 4) { // Ici l'affichage du fichiers
		popup.style.width = 'auto';
		popup.style.left = '12%';
		moreaction(0);
		var all_unit = ["b", "Kb", "Mb", "Gb", "Tb"];
		var unit = all_unit[0];
		
		for(var i = 1; taille > 1000; i++) { // Convertisseur d'unité
			taille = taille / 1000;
			unit = all_unit[i];
		}
		
		taille = String(taille);
		taille = taille.charAt(0) + taille.charAt(1) + taille.charAt(2) + taille.charAt(3) + taille.charAt(4);
		
		packet = '<form method="post" action="./pages/action.php?fichiers=' + nom + '">';
		packet += '<fieldset>';
		packet += '<legend>Fichiers: ' + nom + ' - ' + taille + ' ' + unit + '</legend>';
		packet += '<center>';
		
		switch(methode) {
			case 0: packet += '<p>En construction</p>'; break; // Pour les dossiers
			case 1: packet += '<img class="show" title="' + nom + '" src="' + attempt + '" />'; break; // Pour les images
			case 2: packet += '<audio id="player" ontimeupdate="custom_controls(4);" autoplay>'; // Pour les musiques
				packet += '<source src="' + attempt + '" type="audio/mpeg" />';
				packet += '</audio>';
				packet += '<div style="position: relative;">';
				packet += '<div id="progressbarControl">';
				packet += '<div id="progressbar"></div>';
				packet += '</div>';
				packet += '<input class="controls" id="player_start" type="button" value="||" title="Pause" onclick="custom_controls(1, this);">';
				packet += '<input class="controls" type="button" value=" ■ " title="Stop" onclick="custom_controls(2);">';
				packet += '<span class="volume">';
				packet += '<a class="stick1 volume" onclick="custom_controls(3, 0);" title="MUTE"></a>';
				packet += '<a class="stick2 volume" onclick="custom_controls(3, 0.3);" title="30%"></a>';
				packet += '<a class="stick3 volume" onclick="custom_controls(3, 0.5);" title="50%"></a>';
				packet += '<a class="stick4 volume" onclick="custom_controls(3, 0.7);" title="70%"></a>';
				packet += '<a class="stick5 volume" onclick="custom_controls(3, 1);" title="100%"></a>';
				packet += '</span>';
				packet += '</div>';
				break;
			case 3: packet += '<div class="show">'; // Pour les fichiers textes ou pdf
				packet += '<iframe src="' + attempt + '"></iframe>';
				packet += '</div>';
				break;
			case 4: packet += '<video class="show" controls autoplay>'; // Pour les vidéos
				packet += '<source src="' + attempt + '" type="audio/mpeg" />';
				packet += '</video>';
				break;
		}
		
		packet += '</center>';
		packet += '<br />';
		packet += '<input type="button" onclick="moreaction(1, \'' + nom + '\');" value="Copier" />';
		packet += '<input type="button" onclick="moreaction(2, \'' + nom + '\');" value="Déplacer" />';
		packet += '<input class="WARN" type="button" onclick="moreaction(3, \'' + nom + '\');" value="Supprimer" />';
		packet += ' - ';
		packet += '<a href="' + attempt + '" download><input type="button" value="Télécharger" /></a>';
		packet += '<input type="button" onclick="popupaction(0);" value="Fermer" />';
		packet += '</fieldset>';
		packet += '</form>';
	}
	else if(action == 5) { // Ici l'affichage du tchat IRC
		popup = document.getElementById('popup_irc');
		
		if(attempt == 0) {
			if(popup.innerHTML == '<iframe class="IRC" src="./IRC.php"></iframe>') { packet = ''; }
			else { packet = '<iframe class="IRC" src="./IRC.php"></iframe>'; }
		}
		else {
			if(popup.innerHTML == '<iframe class="IRC" src="./pages/IRC.php"></iframe>') { packet = ''; }
			else { packet = '<iframe class="IRC" src="./pages/IRC.php"></iframe>'; }
		}
	}
	
	popup.innerHTML = packet;
	switch(action) {
		case 3: document.getElementById('nom_dossier').focus(); break;
		default: break;
	}
}

// Nouvelle fonctions de gestions du panneau administrateur
function view_param(action, nameuser, name, surname, sexe, mail, pws, nso, np, profile, taille) {
	var frame_param = document.getElementById('frame_param');
	var selected = document.getElementById('selected');
	var info_param = document.getElementById('info_param');
	
	if(action == 1) { // Changement d'informations utilisateur
		packet = '<div class="info_selected">';
		packet += '<h3 id="selected">Affichage de: ' + nameuser + '</h3>> ';
		packet += '<input type="button" value="Données Utilisateurs" onclick="view_param(3, \'' + nameuser + '\', \'' + name + '\', \'' + surname + '\', \'' + sexe + '\', \'' + mail + '\', \'' + pws + '\', \'' + nso + '\', \'' + np + '\', \'' + profile + '\', \'' + taille + '\');" /> ';
		packet += '<input type="button" value="Paramètre Profile" onclick="view_param(2, \'' + nameuser + '\', \'' + name + '\', \'' + surname + '\', \'' + sexe + '\', \'' + mail + '\', \'' + pws + '\', \'' + nso + '\', \'' + np + '\', \'' + profile + '\', \'' + taille + '\');" />';
		packet += '<br /><br />';
		packet += '<h3>Paramètre Afficher:</h3>';
		packet += '</div>';
		packet += '<div id="info_param">';
		packet += '</div>';
		
		frame_param.innerHTML = packet;
		view_param(2, nameuser, name, surname, sexe, mail, pws, nso, np, profile, taille);
	}
	else if(action == 2) { // Affichage d'informations utilisateur
		packet = '<form action="./pages/verifmcompte.php" method="post">';
		packet += '<h3>Information Personnels:</h3>';
		packet += '<br />';
		packet += '<label>--- Identifiant:</label>';
		packet += '<br />';
		packet += '- <font name="user">' + nameuser + '</font>';
		packet += '<input class="none" type="hidden" name="user" value="' + nameuser + '" />';
		packet += '<br /><br />';
		packet += '<label>--- Nom:</label>';
		packet += '<br />';
		packet += '- ' + name;
		packet += '<br /><br />';
		packet += '<label>--- Prénom:</label>';
		packet += '<br />';
		packet += '- ' + surname;
		packet += '<br /><br />';
		packet += '<label>--- Sexe:</label>';
		packet += '<br />';
		packet += '- ' + sexe;
		packet += '<br /><br />';
		packet += '<label>--- Adresse Mail:</label>';
		packet += '<br />';
		packet += '- ' + mail;
		packet += '<br /><br />';
		packet += '<label>--- Mot de passe:</label>';
		packet += '<br />';
		packet += '- ' + pws;
		packet += '<br /><br />';
		packet += '<label>--- Grade:</label>';
		packet += '<br />';
		packet += '- <select name="profile">';
		
		switch(profile) {
			case "USER": packet += '<option value="USER">USER</option>';
				packet += '<option>ADMIN</option>';
				break;
			
			case "ADMIN": packet += '<option value="ADMIN">ADMIN</option>';
				packet += '<option value="USER">USER</option>';
				break;
		}
		
		packet += '</select>';
		packet += '<br /><br />';
		packet += '<input class="ACT" type="submit" name="special" value="Modifier" title="Modifier les Informations du Compte" />';
		packet += '</form>';
		
		info_param.innerHTML = packet;
	}
	else if(action == 3) {
		packet = '<h3>Espace Disque: </h3><br />';
		packet += '<div id="progressbarControl" style="margin-left: 15px; margin-right: 15px; width: auto;">';
		packet += '<div id="progressbar">';
		packet += '</div>';
		packet += '</div>';
		packet += '<br /><br />';
		packet += '';
		
		info_param.innerHTML = packet;
		switch(action) { case 3: analysedisk(taille); break; }
	}
}

// Cette fonction est dédié pour les commandes de copies déplacements et confirmation de suppresion
function moreaction(action, fichier) {
	var popup = document.getElementById('popupabout');
	
	switch(action) {
		case 0: packet = ''; break; // Ici la copie
		case 1: packet = '<form method="post" action="./pages/action.php?fichiers=' + fichier + '">'; // Ici la copie
			packet += '<fieldset>';
			packet += '<legend>Copier un fichier:</legend>';
			packet += '<p>Copie de "' + fichier + '"</p>';
			packet += '<br />';
			packet += '<label>Vers:</label>';
			packet += '<br />';
			packet += '<input style="width: 98%;" type="text" name="to" id="to" value="./Dossier/sous-Dossier/fichier_à_copier.ext" onfocus="info_tchat(2, this.value);" onblur="info_tchat(2, this.value);" />';
			packet += '<br /><br />';
			packet += '<input class="ACT" type="submit" name="action" value="Copier" />';
			packet += '<input type="button" onclick="moreaction(0);" value="Annuler" />';
			packet += '</fieldset>';
			packet += '</form>';
			break;
		case 2: packet = '<form method="post" action="./pages/action.php?fichiers=' + fichier + '">'; // Ici le déplacement
			packet += '<fieldset>';
			packet += '<legend>Déplacer un fichier:</legend>';
			packet += '<p>Déplacement de "' + fichier + '"</p>';
			packet += '<br />';
			packet += '<label>Vers:</label>';
			packet += '<br />';
			packet += '<input style="width: 98%;" type="text" name="to" id="to" value="./Dossier/sous-Dossier/fichier_à_copier.ext" onfocus="info_tchat(2, this.value);" onblur="info_tchat(2, this.value);" />';
			packet += '<br /><br />';
			packet += '<input class="ACT" type="submit" name="action" value="Déplacer" />';
			packet += '<input type="button" onclick="moreaction(0);" value="Annuler" />';
			packet += '</fieldset>';
			packet += '</form>';
			break;
		case 3: packet = '<form method="post" action="./pages/action.php?fichiers=' + fichier + '">'; // Ici la confirmation de suppression
			packet += '<fieldset>';
			packet += '<legend>Supprimer un fichier:</legend>';
			packet += '<p>Êtes-vous sûre de vouloir supprimer "' + fichier + '" ?</p>';
			packet += '<br /><br />';
			packet += '<input class="WARN" type="submit" name="action" value="Oui" />';
			packet += ' - ';
			packet += '<input type="button" onclick="moreaction(0);" value="Non" />';
			packet += '</fieldset>';
			packet += '</form>';
			break;
	}
	
	popup.innerHTML = packet;
}

// Barre d'analyse espace disque utilisateur
function analysedisk(occupied_space) {
	var progressbar = document.getElementById('progressbar');
	var free_space = 50000000;
	var quotient = occupied_space / free_space;
	var statdisk = Math.ceil(quotient * 100);
	
	progressbar.style.width = statdisk + '%';
	progressbar.innerHTML = '<p style="padding-left: 3px;">' + statdisk + '%</p>';
	
	free_space = ((free_space / 1000) / 1000);
	occupied_space = ((occupied_space / 1000) / 1000);
	occupied_space = String(occupied_space);
	
	switch(occupied_space.charAt(1)) {
		case '.': occupied_space = occupied_space.charAt(0); break;
		default: occupied_space = occupied_space.charAt(0) + occupied_space.charAt(1); break;
	}
	
	progressbar.innerHTML += "<p style='position: absolute;'>--- Espace Occupé: " + occupied_space + "/" + free_space + "Mo</p>";
}

// Personnalisation des controls de la balise <audio>
function custom_controls(action, lvl) {
	var player = document.getElementById('player');
	var starter = document.getElementById('player_start');
	var progressbar = document.getElementById('progressbar');
	//var volume_info = document.getElementById('volume_info');
	
	if(action == 1) { // Lecture et Pause
		if(player.paused) {
			player.play();
			starter.value = "||";
			starter.title = "Pause";
		}
		else {
			player.pause();
			starter.value = " ► ";
			starter.title = "Lecture";
		}
	}
	else if(action == 2) { // Stop puis Recommencer
		player.currentTime = 0;
		player.pause();
		progressbar.style.width = '0%';
		starter.value = " ► ";
		starter.title = "Lecture";
	}
	else if(action == 3) { // Volume
		player.volume = lvl;
		
		/*switch(lvl) {
			case 0: volume_info.innerHTML = "MUTED"; break;
			default: volume_info.innerHTML = lvl * 100 + "%"; break;
		}*/
	}
	else if(action == 4) { // Barre de progression
		switch(player.currentTime) {
			case 0: break;
			default: var quotient = player.currentTime / player.duration; break;
		}
		
		var statprogress = Math.ceil(quotient * 100);
		
		progressbar.style.width = statprogress + '%';
	}
}

// Annimation pour l'affichage de texte par défaut dans une barre input
function info_tchat(obj, msg) {
	if(obj == 1) { // Pour l'input du tchat
		var entry = document.getElementById('text_input');
		//var meta = document.getElementById('refresh');
		
		if(msg == 'Ecrivez votre message...') {
			//meta.content = "50;url=./IRC.php";
			entry.style.color = '#CCCCCC';
			entry.value = '';
		}
		else if(msg == '') {
			//meta.content = "5;url=./IRC.php";
			entry.style.color = '#999999';
			entry.value = 'Ecrivez votre message...';
		}
	}
	else if(obj == 2) { // Pour l'input de chemin de copie ou déplacement de fichiers
		var entry = document.getElementById('to');
		
		if(msg == './Dossier/sous-Dossier/fichier_à_copier.ext') {
			entry.style.color = '#CCCCCC';
			entry.value = './';
		}
		else if(msg == './') {
			entry.style.color = '#999999';
			entry.value = './Dossier/sous-Dossier/fichier_à_copier.ext';
		}
	}
}

// Fonction de changement de mode utilisateur pour l'administrateur user
function adminswitch(mode) {
	setTimeout(function() {
		switch(mode) {
			case 1: document.location = "./admin.php"; break; // ADMIN MOD
			case 2: document.location = "./client.php"; break; // USER MOD
		}
	}, 350);
}

// Cette fonction est pour la deconnexion du compte
function disconnect(stat, method) {
	if(method == 0) {
		switch(stat) {
			case 0: popupaction(0); break;
			case 1: document.location = "./pages/disconnect.php"; break;
		}
	}
	else if(method == 1) { document.location = "./disconnect.php"; }
}

// Fonction de développement /!\ PAS TOUCHER !!!!
function other(op) {
	switch(op) {
		case 0: document.location = "../client.php"; break;
		case 1: document.location = "./pages/other.php"; break;
	}
}

/*****************************************************************************
function hide_pubs() {
	for(var i = 0; i < 1; i++) {
		switch(i) {
			case 0: var pub = document.getElementById('av_toolbar_iframe'); break;
			case 1: var pub = document.getElementById('av_toolbar_regdiv'); break;
		}
		
		pub.style.width = 0;
		pub.style.height = 0;
		pub.style.position = "absolute";
		pub.innerHTML = "";
	}
	
	document.body.style.marginTop = 0;
}
*****************************************************************************/

/******
* END *
******/

