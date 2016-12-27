<!DOCTYPE html>
<!-- client.php -->
<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="icon" type="image/png" href="../image/cloud.png" />
		<script language="javascript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<?php
		// mieux de le faire avec un try car la connexion sera permanante
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor');
		}
		catch(Exception $e) { // au cas-où si ça foire il affiche la couille dans le paté
			die('ERROR : '.$e->getMessage());
		}
	?>
	<body onload="startTime();">
		<header>
			<div class="time" id="txt"></div>
			<div class="time info">
				<?php
					if(isset($_SESSION['user'])) {
						$user = $_SESSION['user'];
						echo("$user");
					}
					else {
						header("location: ./index.html");
					}
				?>
			</div>
			<div class="h-butons">
				<input class="color" type="button" value="Créer un dossier" onclick="popupaction(3);" />
				<input class="color" type="button" value="Importer" onclick="popupaction(1, 0 , 0);" />
				<input class="color" type="button" value="Déconnexion" onclick="popupaction(2);" />
			</div>
			<h1>Stock One</h1>
		</header>
		<section>
			<aside class="left">
				<h2>Racine [./]</h2>
				<div class="content">
					<?php
						$data = $bdd->query('SELECT * FROM donnee');
						
						while($file = $data->fetch()) {
							if($user == $file[1]) {
								if($file[2] == 'folder') {
									echo("<img class=\"classement\" height=\"15px\" src=\"./pics/folder.png\" /><input class=\"list\" type=\"button\" value=\"$file[3]\" title=\"$file[3]\" /><br />");
								}
								else if($file[2] == 'png' || $file[2] == 'jpeg' || $file[2] == 'jpg' || $file[2] == 'gif' || $file[2] == 'bmp' ) {
									echo("<img class=\"classement\" height=\"15px\" src=\"./pics/gallery.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 1, '$file[3]', '$file[5]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />");
								}
								else if($file[2] == 'mp3' || $file[2] == 'wav' || $file[2] == 'wma' || $file[2] == 'aac' || $file[2] == 'ac3' || $file[2] == 'm4a') {
									echo("<img class=\"classement\" height=\"15px\" src=\"./pics/music.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 2, '$file[3]', '$file[5]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />");
								}
								else if($file[2] == 'txt' || $file[2] == 'log' || $file[2] == 'py' || $file[2] == 'pl' || $file[2] == 'js' || $file[2] == 'css' || $file[2] == 'php' || $file[2] == 'html' || $file[2] == 'sql' || $file[2] == 'pdf'){
									echo("<img class=\"classement\" height=\"15px\" src=\"./pics/text-file.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 3, '$file[3]', '$file[5]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />");
								}
								else if($file[2] == 'mp4') {
									echo("<img class=\"classement\" height=\"15px\" src=\"./pics/movie.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 4, '$file[3]', '$file[5]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />");
								}
								else {
									echo("<img class=\"classement\" height=\"15px\" src=\"./pics/text-file.png\" /><a href=\"$file[4]$file[3]\" download><input class=\"list\" type=\"button\" value=\"$file[3]\" title=\"$file[3]\" /></a><br />");
								}
							}
						}
					?>
				</div>
			</aside>
			<article>
				<h2>Dossiers []</h2>
				<div class="content">
					<?php
						echo("en construction...");
					?>
				</div>
			</article>
			<aside class="right">
				<h2>Fichiers []</h2>
				<div class="content">
					<?php
						echo("en construction...");
					?>
				</div>
			</aside>
			<!-- Le changement de popup s'opérera sur cette balise div depuis le javascript -->
			<div id="popup">
				
			</div>
			<div id="popupabout">
				<?php
					// Cette partie du code servira pour la confirmation de commande entré auparavant
					if(!isset($_GET['code'])) {
						echo("");
					}
					else {
						if($_GET['code'] == '1') {
							$action = 'Copie';
						}
						else if($_GET['code'] == '2') {
							$action = 'Déplacement';
						}
						else if($_GET['code'] == '3') {
							$action = 'Suppression';
						}
						
						if($_GET['etat'] == "OK") {
							$msg = '<font id="msg3">> L\'action menet au fichier à bien été éxecuter.</font>';
						}
						else if($_GET['etat'] == "ERREUR") {
							$msg = '<font id="msg0">> L\'action menet au fichier à rencontrer une erreur.</font>';
						}
						
						echo("<fieldset>");
						echo("<Legend>Confirmation de $action:</Legend>");
						echo($msg);
						echo("<br /><br />");
						echo('<input type="button" onclick="moreaction(0); document.location = \'./client.php\';" value="Fermer" />');
						echo("</fieldset>");
					}
				?>
			</div>
		</section>
		<footer>
			<h4>Auteur: Groupe STI2D SIN Déodat de Séverac - 2016 Novembre</h4>
		</footer>
	</body>
</html>
<!-- END -->
