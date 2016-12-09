<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		// mieux de le faire avec un try car la connexion sera permanante
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one-710;charset=utf8', 'root', '');
		}
		catch(Exception $e) { // au cas-où si ça foire il affiche la couille dans le paté
			die('ERROR : '.$e->getMessage());
		}
	?>
	<body>
		<header>
			<h1>Stock One</h1>
		</header>
		<section>
			<?php
				$usr = $_POST['utilisateur'];
				$pws = $_POST['pws'];
				$name = $_POST['Nom'];
				$subname = $_POST['prenom'];
				$sexe = $_POST['genre'];
				$mail = $_POST['email'];
				$notif = $_POST['notif'];
				$notifpart = $_POST['notifpart'];
				
				echo("<p>Les informations suivants sont en cours de traitement: <p><br/><br/>");
				echo("<p>> Nom d'utilisateur: $usr <br/>");
				echo("<p>> Nom: $name <br/>");
				echo("<p>> Prénom: $subname <br/>");
				echo("<p>> Votre sexe: $sexe <br/>");
				echo("<p>> Votre addresse mail: $mail <br/>");
				echo("<p>> Recevoir des notification de So: $notif <br/>");
				echo("<p>> Avoir contact avec les partenaires de So: $notifpart <br/></p>");
				
				
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
