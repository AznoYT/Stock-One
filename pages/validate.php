<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		// Verifie la co par toi même par je me suis pris un refoule par ton serveur
		// mieux de le faire avec un try car la connexion sera permanante
		try {
			$bdd = new PDO('mysql:host=51.255.34.189;dbname=Stock-One;charset=utf8', 'root', 'ugo31140');
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
			<?php
				echo 'Utilisateur :';
				echo $_POST['utilisateur'];
				echo "</br>";
				echo 'Nom :';
				echo $_POST['Nom'];
				echo "</br>";
				echo 'Prénom :';
				echo $_POST['prenom'];
				echo "</br>";
				echo 'Sexe :';
				echo $_POST['genre'];
				echo "</br>";
				echo 'Email:';
				echo $_POST['email'];
				echo "</br>";
				echo 'Notif Stock-One:';
				echo $_POST['notif'];
				echo "</br>";
				echo 'Notif Partenaire:';
				echo $_POST['notifpart'];
				
				// J'ai foutu la connexion entre le head et le body
				
				$sql = "INSERT INTO user (utilisateur, nom, prenom, genre, email, Notif Stock-One, Notif Partenaire)
				VALUES ('utilisateur', 'Nom', 'prenom', 'genre', 'email', 'notif', 'notifpart')";

				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
