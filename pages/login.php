<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Identification</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
		<link rel="icon" type="image/png" href="../image/cloud-10 (1).png" />
	</head>
	<?php
		// mieux de le faire avec un try car la connexion sera permanante
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}
		catch(Exception $e) { // au cas-où si ça foire il affiche la couille dans le paté
			die('ERROR : '.$e->getMessage());
		}
	?>
	<body>
		<header>
			<h1>Stock One </h1>
		</header>
		<section>
			<form method="post" action="veriflogin.php">
				<fieldset>
					<legend>Connexion:</legend>
					<label>Nom d'Utilisateur:</label><br>
					<input type="text" name="lutilisateur" ><br>
					<label>Mot de passe:</label><br>
					<input type="password" name="lpws" ><br><br>
					<input type="submit" value="Connexion">
				</fieldset>
			</form>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
