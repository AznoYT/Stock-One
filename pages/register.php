<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Inscription</title>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<script language="javascript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<body>
		<header>
			<h1>Stock One </h1>
		</header>
		<section>
			<form method="get" action="validate.php">
				<fieldset>
					<legend>Information Personnel:</legend>
					Nom:<br>
					<input type="text" name="Nom" value=""><br>
					Prénom:<br>
					<input type="text" name="prenom" value=""><br><br>
					<input type="radio" name="genre" value="Homme" checked> Homme<br>
					<input type="radio" name="genre" value="Femme"> Femme<br>
					<input type="radio" name="genre" value="Autres"> Autres<br><br>
					E-mail:<br>
					<input type="email" name="email"><br><br>
					<input type="submit" value="Envoyer"><input type="reset" value="Tout Effacer">
				</fieldset>
			</form>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
