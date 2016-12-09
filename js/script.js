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

