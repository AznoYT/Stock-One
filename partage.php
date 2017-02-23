<!DOCTYPE html>
<!-- partage.php -->
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Partage</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="stylesheet" type="text/css" href="./css/system.css" />
		<link rel="stylesheet" type="text/css" href="./css/system.css" />
		<link rel="icon" type="image/png" href="./pics/icon.png" />
		<script language="javascript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<body onload="startTime();">
		<header>
			<div class="time" id="txt"></div>
			<div class="h-butons">
				<input type="button" value="Connexion" title="Se Connecter à un Compte" onclick="popuplogin(1);" />
				<input type="button" value="Inscription" title="Se Créer un Compte" onclick="popuplogin(2);" />
				<input type="button" value="Déverrouiller" title="Demande un code de déverrouillage de fichier" onclick="popupaction(6);" />
				<input type="button" value="Retour" title="Retour à la page d'accueil" onclick="document.location = './#';" />
			</div>
			<a title="Page d'Accueil" href="./#">
				<img class='logo' height="30px" src="./pics/logo.png" />
				<h1>Stock One</h1>
			</a>
		</header>
		<section>
			<aside class="left">
				
			</aside>
			<article id="article"></article>
			<aside class="right">
				
			</aside>
			<div class="about">
				<iframe src="./php/annimation.html"></iframe>
			</div>
			<div id="popup"></div>
			<div id="popupabout"></div>
		</section>
		<footer>
			<h4>Auteur: Groupe STI2D SIN Déodat de Séverac - 2016 Novembre</h4>
		</footer>
		<script>
			popupaction(6);
		</script>
	</body>
</html>
<!-- END -->
