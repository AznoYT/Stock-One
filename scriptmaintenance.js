/************************
*                       *
*    File: script.js    *
*                       *
************************/

var packet = '';
var packet0 = '';
var a = 0;

// Affichage du temps de la machine
function startTime() {
	var today = new Date();
	var h = today.getHours();
	var m = today.getMinutes();
	var s = today.getSeconds();
	m = checkTime(m);
	s = checkTime(s);
	document.getElementById('txt').innerHTML = h + ":" + m + ":" + s;
	t = setTimeout(function() { startTime(); }, 500);
	if(a <= 4) { a = Note_annim(a); }
	//hide_pubs();
}

function checkTime(i) {
	if (i<10) { i = 0 + i; }
	return i;
}

// Ajout d'information de note
function Note_annim(i) {
	var output = document.getElementById('Note_MAJ');
	var warning_msg = '<fieldset id="Note">';
	warning_msg += '<div class="title"><h3 class="alert">ATTENTION ! Une Maintenance est en cours</h3></div>';
	warning_msg += '<img height="100px" width="100px" src="./pics/alert.png" />';
	warning_msg += '<p class="alert alert_content">Des Mises à jours sont en cours</p>';
	warning_msg += '</fieldset>';
	
	if(output != undefined) {
		var msg = [document.getElementById('text_0').value, document.getElementById('text_1').value, document.getElementById('text_2').value, document.getElementById('text_3').value];
		
		switch(i) {
			case 4: document.getElementById('article').innerHTML = warning_msg; break;
			default: packet0 += msg[i]; break;
		}
		
		output.innerHTML = packet0;
		i++;
		return i;
	}
}
//Compte à rebours
// Set the date we're counting down to
var countDownDate = new Date("Mar 10, 2017 17:51:00").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

// Get todays date and time
var now = new Date().getTime();

// Find the distance between now an the count down date
var distance = countDownDate - now;

// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);

// Output the result in an element with id="demo"
document.getElementById("demo").innerHTML ="Temps restant avant fin de la maintenance: "+ days + "J " + hours + "H "
+ minutes + "M " + seconds + "S ";
    
// If the count down is over, write some text 
if (distance < 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML = "Réouverture du site sous peu" + "</br>" + "<a href='index.html'>Accéder au Site</a>";
	}
}, 1000);
			
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

