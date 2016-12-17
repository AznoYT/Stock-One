<!DOCTYPE html>
<!-- veriflogin.php -->
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Connexion</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		// mieux de le faire avec un try car la connexion sera permanante
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
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
				$sql = 'SELECT * FROM user';
				$login = $bdd->query($sql);
				$lusr = $_POST['lutilisateur'];
				$lpws = $_POST['lpws'];
				
				while ($usr = $login->fetch()) {
					if($lusr == $usr[0]) {
						if($lpws == $usr[5]) {
							header("location: ../client.php");
						}
					}
					else {
						$try = 0;
					}
				}
				if($try == 0) {
					echo "Nom d'utilisateur ou mot de passe incorrect";
				}
				$bdd=null;
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
