<!DOCTYPE html>
<!-- verifmcompte.php -->
<html>
	<?php
		session_start();
		try { $bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
		catch(Exception $e) { die('ERROR : '.$e->getMessage()); }
	?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<link rel="stylesheet" type="text/css" href="../css/system.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body>
		<header>
			<div class="time info">
				<?php
					if(isset($_SESSION['user'])) {
						$user = $_SESSION['user'];
						$_SESSION['mode'] = "client";
						echo("<a class='profile' href='../client.php'><img class='avatar' height='25px' src='../pics/user.png' />$user</a>");
					}
					else { header("location: ../index.html"); }
				?>
			</div>
			<h1>Stock One</h1>
		</header>
		<section>
			<div id="popup"></div>
			<?php
				if(!isset($_POST['special'])) {
					$nom = $_POST['mnom'];
					$pass = $_POST['pws1'];
					$prenom = $_POST['mprenom'];
					$mail = $_POST['memail'];
					
					echo("<p>Les informations suivants sont en cours de traitement: <p><br/><br/>");
					
					// Modification des informations utilisateur
					if($nom == '' && $prenom == '' && $mail == '') { echo(""); } // Si il ya pas d'infos personnels à traiter
					else {
						echo("<p>> Nom: $nom <br/>");
						echo("<p>> Prénom: $prenom <br/>");
						echo("<p>> Votre addresse mail: $mail <br/>");
						
						$stmt = $bdd->prepare('UPDATE user SET nom="'.$_POST['mnom'].'", prenom="'.$_POST['mprenom'].'", email="'.$_POST['memail'].'" WHERE utilisateur="'.$_SESSION['user'].'"');
						$stmt->execute();
					}
					
					$stmt = $bdd->prepare('UPDATE user SET pws="'.$_POST['pws1'].'" WHERE utilisateur="'.$_SESSION['user'].'"');
					$stmt->execute();
					
					header("location: ./compteuser.php?code=5&etat=OK");
				}
				else {
					if($_POST['special'] == 'Modifier') {
						$stmt = $bdd->prepare('UPDATE user SET GRADE="'.$_POST['profile'].'" WHERE utilisateur="'.$_POST['user'].'"');
						$stmt->execute();
						
						header("location: ../admin.php?code=5&etat=OK");
					}
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