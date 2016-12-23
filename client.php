<!DOCTYPE html>
<!-- client.php -->
<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="icon" type="image/png" href="../image/cloud-10 (1).png" />
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
				<input class="color" type="button" value="Créer un dossier" onclick="popupaction(4);" />
				<input class="color" type="button" value="Importer" onclick="popupaction(1);" />
				<input class="color" type="button" value="Télécharger" onclick="popupaction(2);" />
				<input class="color" type="button" value="Déconnexion" onclick="popupaction(3);" />
			</div>
			<h1>Stock One</h1>
		</header>
		<section>
			<aside class="left">
				<h2>Racine [./]</h2>
				<div class="content">
					<?php
						$data = $bdd->query('SELECT * FROM donnee');
						
						while($identifiant = $data->fetch()) {
							if($user == $identifiant[1]) {
								echo($identifiant[3]."<br />");
							}
						}
					?>
				</div>
			</aside>
			<article>
				<h2>Dossiers []</h2>
				<div class="content">
					<?php
						
					?>
				</div>
			</article>
			<aside class="right">
				<h2>Fichiers []</h2>
				<div class="content">
					<?php
						
					?>
				</div>
			</aside>
			<!-- Le changement de popup s'opérera sur cette balise div depuis le javascript -->
			<div id="popup">
				
			</div>
		</section>
		<footer>
			<h4>Auteur: Groupe STI2D SIN Déodat de Séverac - 2016 Novembre</h4>
		</footer>
	</body>
</html>
<!-- END -->
