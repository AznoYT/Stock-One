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
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor');
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
				// Enfin le script d'insertion de fichier, Je fais d'abord l'upload pour pouvoir les lire ensuite
				$req = $bdd->prepare('INSERT INTO donnee(nom, public, identifiant) VALUES(?, ?, ?)');
				$req->execute(array($_POST['file'], $_POST['Public'], $_SESSION['user']));
				
				$req = $bdd->query('SELECT nom, public, identifiant FROM donnee');
				$data = $req->fetch();
				
				if (!isset($_FILES['file'])) {
					header('location: ../client.php');
				}
				else {
					// Premiers test avec une image
					$extension_ok = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
					$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );
					if ( in_array($extension_upload,$extensions_ok) ) echo "Extension validate";
					$path = "files/{$data['nom']}.{$extension_upload}";
					$resultat = move_uploaded_file($_FILES['file']['tmp_name'],$path);
					if ($resultat) echo "Transfert réussi";
					header('location: ../client.php');
				}
				/**************************************************************
				* Pour le moment il n'y a rien qui part je continue le script *
				**************************************************************/
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
