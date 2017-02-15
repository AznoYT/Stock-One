<!DOCTYPE html>
<!-- client.php -->
<html>
	<?php
		include('./php/bdd_access.php'); $a = NULL;
		include('./php/module.php');
	?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud [USER MODE]</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="stylesheet" type="text/css" href="./css/scroll.css" />
		<link rel="icon" type="image/png" href="./pics/icon.png" />
		<?php if(isset($_SESSION['user'])) { include('./php/theme.php'); } ?>
		<script language="javascript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<body onload="startTime();">
		<header>
			<div class="time" id="txt"></div>
			<div class="time info">
				<?php
					if(isset($_SESSION['user'])) {
						$user = $_SESSION['user'];
						$_SESSION['mode'] = 'client';
						echo("<a class='profile' title='Paramètre du Compte Utilisateur' href='./compteuser.php'><img class='avatar' height='25px' src='./pics/".$dir."user.png' />$user</a>");
					}
					else { header('location: ./#'); }
				?>
			</div>
			<div class="h-butons">
				<?php
					if($_SESSION['profile'] == 'ADMIN') {
						echo('<div class="userswitch">');
						echo('<input type="checkbox" name="userswitch" class="userswitch-checkbox" id="myuserswitch" onclick="adminswitch(1);" />');
						echo('<label class="userswitch-label" for="myuserswitch">');
						echo('<span class="userswitch-inner"></span>');
						echo('<span class="userswitch-switch"></span>');
						echo('</label>');
						echo('</div>');
					}
					else if($_SESSION['profile'] == 'USER') { echo(''); }
				?>
				<input type="button" value="Tchat" title="Faire apparaître le tchat IRC" onclick="popupaction(5);" />
				<input type="button" value="Créer un dossier" onclick="popupaction(3);" />
				<input type="button" value="Importer" onclick="popupaction(1, 0 , 0);" />
				<input type="button" value="Déconnexion" onclick="popupaction(2);" />
			</div>
			<img class='logo' height="30px" src="./pics/logo.png" />
			<h1>Stock One</h1>
		</header>
		<section id="UserPanel">
			<aside class="left">
				<h2>Racine [./]</h2>
				<div class="content">
					<form action method="get">
						<?php
							for($tour = 0; $tour < 2; $tour++) { // Code réagencer pour le listing des dossiers séparer des fichiers
								$data = [$bdd->query('SELECT * FROM donnee'), $bdd->query('SELECT * FROM donnee'), $bdd->query('SELECT * FROM donnee')];
								
								switch($tour) {
									case 0:
										while($file = $data[0]->fetch()) {
											if($user == $file[1]) { list_dossiers($file, $dir, $a); }
										} break;
									
									case 1:
										while($file = $data[0]->fetch()) {
											if($user == $file[1]) { list_fichiers($file, $dir, $a); }
										} break;
								}
							}
						?>
					</form>
				</div>
			</aside>
			<article>
				<h2>Dossier [<?php if(!isset($_GET['folder'])) { echo(''); } else { echo($_GET['folder']."/"); } ?>]</h2>
				<div class="content">
					<form action method="get">
						<?php
							if(!isset($_GET['folder'])) { echo(''); }
							else if($_GET['folder']) { echo("<img class=\"classement\" height=\"15px\" src=\"./pics/".$dir."folder.png\" /><input class=\"list\" type=\"submit\" value=\"..\" title=\"..\" /><br />"); }
							
							while($file = $data[1]->fetch()) {
								if($user == $file[1]) {
									if(!isset($_GET['folder'])) { list_dossiers($file, $dir, $a); }
									
									if(!isset($file[8])) { echo(''); }
									else if($file[8] == $_GET['folder']) { list_dossiers($file, $dir, $a); }
								}
							}
						?>
					</form>
				</div>
			</article>
			<aside class="right">
				<h2>Fichiers du dossier</h2>
				<div class="content">
					<?php
						while($file = $data[2]->fetch()) {
							if($user == $file[1]) {
								if(!isset($_GET['folder'])) { list_fichiers($file, $dir, $a); }
							}
						}
					?>
				</div>
			</aside>
			<!-- Le changement de popup s'opérera sur cette balise div depuis le javascript -->
			<div id="popup"></div>
			<div id="popupabout">
				<?php
					if(!isset($_GET['code'])) { echo(''); }
					else {
						$frame2 = ['client.php', 'client.php', 'client.php', 'compteuser.php', 'compteuser.php'];
						
						include('./php/msg.php');
					}
				?>
			</div>
		</section>
		<footer>
			<h4>Auteur: Groupe STI2D SIN Déodat de Séverac - 2016 Novembre</h4>
		</footer>
		<div id="popup_irc"></div>
	</body>
</html>
<!-- END -->
