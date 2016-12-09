<!Doctype HTML>
<!-- index.html -->
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<script language="javascript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<body onload="startTime()">
		<header>
			<div class="time" id="txt"></div>
			<div class="h-butons">
				<a href="./pages/upload.php"><input class="color" type="button" value="Importer"></input></a>
				<a href="./pages/download.php"><input class="color" type="button" value="Télécharger"></input></a>
				<a href="./pages/disconnect.php"><input class="color" type="button" value="Déconnexion"></input></a>
			</div>
			<div class="dev">
				<input class="color" type="button" value="INDEX" onclick="dev(1);" />
				<input class="color" type="button" value="CLIENT" onclick="dev(2);" />
			</div>
			<h1>Stock One</h1>
		</header>
		<section>
			<aside class="left">
				<h2>Racine</h2>
				<div class="content">
					<?php
						echo "en construction";
					?>
				</div>
			</aside>
			<article>
				<h2>Dossiers</h2>
				<div class="content">
					<?php
						echo "en construction";
					?>
				</div>
			</article>
			<aside class="right">
				<h2>Fichiers</h2>
				<div class="content">
					<?php
						echo "en construction";
					?>
				</div>
			</aside>
		</section>
		<footer>
			<h4>Auteur: Groupe STI2D SIN Déodat de Séverac - 2016 Novembre</h4>
		</footer>
	</body>
</html>
<!-- END -->
