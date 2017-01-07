<!DOCTYPE html>
<!-- action.php -->
<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
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
				function insertion($utilisateur ,$extension, $nom, $dir, $publique, $COMMAND) {
					// Dans la fonction il y aura l'insertion de nouvel donnée dans la database. Elle sera ensuite appeler par chaque conditions
					
					return 'OK';
				}
				
				$user = $_SESSION['user'];
				$fichiers = $_GET['fichiers'];
				$path = "../files/$user/$fichiers";
				
				if(!isset($_POST['to'])) {
					$pathpaste = NULL;
				}
				else {
					$pathpaste = "../files/$user/".$_POST['to']."/";
				}
				
				echo("> fichiers à traiter: $path<br />");
				
				if(!isset($_POST['action'])) { // Si il s'est passé une couille encore, eh bah ça marque une erreur
					$code = "0";
					$etat = "ERREUR";
					echo("> Echec de traitement. #ERROR: COMMAND NON TROUVER");
				}
				else if($_POST['action'] == 'Copier') { // La copie
					$code = "1";
					echo("> Copie du fichier: $fichiers vers $pathpaste");
					$etat = insertion();
				}
				else if($_POST['action'] == 'Déplacer') { // Le déplacement
					$code = "2";
					echo("> Déplacement du fichier: $fichiers vers $pathpaste");
					$etat = insertion();
				}
				else if($_POST['action'] == 'Oui') { // La suppression
					$code = "3";
					echo("> Suppression du fichier: $fichiers");
					$etat = insertion();
				}
				else { // Là c'est pour un cas extrêmement rare
					$code = "0";
					$etat = "INCONNU";
					echo("> Echec de traitement. #ERROR: COMMAND INCONNU");
				}
				
				header("location: ../client.php?code=$code&etat=$etat");
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
