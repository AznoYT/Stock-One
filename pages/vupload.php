<!DOCTYPE html>
<!-- vupload.php -->
<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		// Bon tu connais la routine pour le mode de connexion on va pas s'attarder là dessus
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
			<div id="popup">
				
			</div>
			<?php
				// Enfin le script d'insertion de fichier, Je fais d'abord l'upload pour pouvoir les lire ensuite
				if(!isset($_POST['Public'])) {
					$publicstat = 'n';
				}
				else {
					$publicstat = 'y';
				}
				
				if(!isset($_FILES['fichiedrs'])) {
					echo("> Pas de fichiers détecter.");
				}
				else {
					// Premiers test avec une image
					$req = $bdd->prepare('INSERT INTO donnee(identifiant, nom, public) VALUES(?, ?, ?)');
					$req->execute(array($_SESSION['user'], $_FILES['fichiers']['name'], $publicstat));
					
					$req = $bdd->query('SELECT identifiant, nom, public FROM donnee');
					$data = $req->fetch();
					
					$extensions_ok = array('jpg', 'jpeg', 'gif', 'png');
					$extension_upload = strtolower(substr(strrchr($_FILES['fichiers']['name'], '.'), 1));
					if(in_array($extension_upload, $extensions_ok)) {
						echo("> Extension valide.<br />");
					}
					$path = "../files/{$data['nom']}";
					$resultat = move_uploaded_file($_FILES['fichiers']['tmp_name'], $path);
					if($resultat) {
						echo("> Transfert réussi.");
					}
					header('location: ../client.php');
				}
			?>
			<script type="text/javascript">
				popupaction(1, 1);
			</script>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
