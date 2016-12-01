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

