<?php
	// session.php
	// Ce fichier regroupe la portion de code des variables "$_SESSION['user']"
	if(isset($_SESSION['user'])) {
		$user = $_SESSION['user'];
		if($page == 'admin.php' || $page == 'filelist.php') { $_SESSION['mode'] = 'admin'; }
		else { $_SESSION['mode'] = 'client'; }
		if($page == 'compteuser.php') { $href = 'client.php'; }
		else if($page != 'compteuser.php') { $href = 'compteuser.php'; }
		if(!isset($dir)) { $dir = NULL; }
		if($page != 'filelist.php') { echo("<a class='profile' title='Paramètre du Compte Utilisateur' href='./$href'><img class='avatar' height='25px' src='./pics/".$dir."user.png' />$user</a>"); }
	}
	else {
		if($page == 'admin.php' || $page == 'client.php' || $page == 'compteuser.php') { header('location: ./#'); }
		else { header('location: ../#'); }
	}
	// END
?>
