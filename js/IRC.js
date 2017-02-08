/*********************
*                    *
*    File: IRC.js    *
*                    *
*********************/

// Récupération des donnée par protocol XML
if(window.XMLHttpRequest) { obj = new XMLHttpRequest(); } // Chrome, IE, etc...
else if(window.ActiveXObject) { obj = new ActiveXObject("Microsoft.XMLHTTP"); } // Pour FireFox
if(obj.overrideMimeType) { obj.overrideMimeType("text/xml"); } // Safari le sheitan navigateur d'apple

function refresh_tchat(tchat) { // Fonction de récupération de donnée d'un fichier
	var output_tchat = document.getElementById('tchat_area');
	
	obj.open('GET', tchat, false);
	obj.send(null);
	
	output_tchat.innerHTML = obj.responseText;
}

function startTime() {
	var output_tchat = document.getElementById('tchat_area');
	t = setTimeout(function() { startTime(); }, 500);
	refresh_tchat(lien);
}

/******
* END *
******/

