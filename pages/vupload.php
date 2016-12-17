<!DOCTYPE html>
<!-- vupload.php -->
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		// mieux de le faire avec un try car la connexion sera permanante
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', '');
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
				// Test si le fichier a bien été envoyé et s'il n'y a pas d'erreur
				if(isset($_FILES['file']) AND $_FILES['file']['error'] == 0) {
					// Test si le fichier n'est pas trop gros
					if($_FILES['file']['size'] <= 10000000) {
						// Test si l'extension est autorisée
						$infosfichier = pathinfo($_FILES['file']['name']);
						$extension_upload = $infosfichier['extension'];
						$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'rar', 'zip', 'doc', 'php', 'mp3', 'mp4');
						
						if(in_array($extension_upload, $extensions_autorisees)) {
							// On peut valider le fichier et le stocker définitivement
							
							move_uploaded_file($_FILES['file']['tmp_name'], 'fichiers/' . basename($_FILES['file']['name']));
							echo "L'envoi a bien été effectué !";
						}
					}
				}
			?>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
