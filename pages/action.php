<!DOCTYPE html>
<!-- action.php -->
<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="icon" type="image/png" href="../image/cloud.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}
		catch(Exception $e) {
			die('ERROR : '.$e->getMessage());
		}
	?>
	<body>
		<header>
			<h1>Stock One </h1>
		</header>
		<section>
			<?php
				// Ce fichiers contiendra les commandes de suppressions et de copies
				$user = $_SESSION['user'];
				$fichiers = $_GET['fichiers'];
				$path = "../files/$user/$fichiers";
				
				echo("> fichiers à traiter: $path");
				
				if(!isset($_POST['action'])) {
					echo("> Echec de traitement. #ERROR: COMMAND INCONNU");
				}
				else if($_POST['action'] == 'Copier') { // La copie
					
				}
				else if($_POST['action'] == 'Déplacer') { // Le déplacement
					
				}
				else if($_POST['action'] == 'Supprimer') { // La suppression
					
				}
				
				//header('location: ../client.php');
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->