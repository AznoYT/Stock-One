<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
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
				
				$servername = "51.255.34.189";
				$username = "root";
				$password = "ugo31140";
				$dbname = "Stock-One";

				// Create connection
				$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

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
