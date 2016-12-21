<!DOCTYPE html>
<!-- veriflogin.php -->
<?php session_start() ?>
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
				$try = 0;
				
				while($usr = $login->fetch()) {
					if($lusr == $usr[0]) {
						if($lpws == $usr[5]) {
							$try = 1;
							$_SESSION['user'] = $_POST['lutilisateur'];
							header("location: ../client.php?user=$lusr");
						}
					}
				}
				if($try == 0) {
					echo("<script>alert('Nom d\'utilisateur ou mot de passe incorrect'); document.location = '../index.html';</script>");
				}
				$bdd = null;
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
