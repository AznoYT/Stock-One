<?php
	// session.php
	// Ce fichier regroupe la portion de code des variables "$_SESSION['user']"
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		if($page != 'admin.php') { $_SESSION['mode'] = 'client'; }
		else if($page == 'admin.php') { $_SESSION['mode'] = 'admin'; }
		if($page == 'compteuser.php') { $page = 'client.php'; }
		else if($page != 'compteuser.php') { $page = 'compteuser.php'; }
		echo("<a class='profile' title='Paramètre du Compte Utilisateur' href='./$page'><img class='avatar' height='25px' src='./pics/".$dir."user.png' />$user</a>");
	}
	else { header('location: ./#'); }
	// END
?>