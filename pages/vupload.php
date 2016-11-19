<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body>
		<header>
			<h1>Stock One </h1>
		</header>
		<section>
			<?php
				// Test si le fichier a bien été envoyé et s'il n'y a pas d'erreur
				if (isset($_FILES['file']) AND $_FILES['file']['error'] == 0)
				{
						// Test si le fichier n'est pas trop gros
						if ($_FILES['file']['size'] <= 10000000)
						{
								// Test si l'extension est autorisée
								$infosfichier = pathinfo($_FILES['file']['name']);
								$extension_upload = $infosfichier['extension'];
								$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png', 'rar', 'zip', 'doc', 'php', 'mp3', 'mp4');
								if (in_array($extension_upload, $extensions_autorisees))
								{
										// On peut valider le fichier et le stocker définitivement
										move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . basename($_FILES['file']['name']));
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