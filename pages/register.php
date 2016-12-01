<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Inscription</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body>
		<header>
			<h1>Stock One </h1>
		</header>
		<section>
			<form method="post" action="validate.php">
				<fieldset>
					<legend>Information Personnel:</legend>
					<label>Nom d'utilisateur:</label><br>
					<input type="text" name="utilisateur" value=""><br>
					<label>Nom:</label><br>
					<input type="text" name="Nom" value=""><br>
					<label>Prénom:</label><br>
					<input type="text" name="prenom" value=""><br><br>
					<label>Sexe:</label><br>
					<input type="radio" name="genre" value="Homme" checked> Homme<br>
					<input type="radio" name="genre" value="Femme"> Femme<br>
					<input type="radio" name="genre" value="Autres"> Autres<br><br>
					<label>E-mail:</label><br>
					<input type="email" name="email"><br/><br/>
					<label>Mot de passe:</label><br/>
					<input type="password" name="pws" value=""><br>
					<input type="password" name="pws" value=""><br><br>
					<input type="checkbox" name="notif" value="notif"> Souhaitez vous recevoir des notifications de la part de Stock-One<br>
					<input type="checkbox" name="notifpart" value="notifpart"> Souhaitez vous que les Partenaires de Stock-One puisse vous Contacter<br><br>
					<input type="submit" value="Envoyer">
					<input type="reset" value="Tout Effacer">
				</fieldset>
			</form>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
