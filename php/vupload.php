<!DOCTYPE html>
<!-- vupload.php -->
<html>
	<?php include('./bdd_access.php'); ?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<link rel="stylesheet" type="text/css" href="../css/system.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body onload="startTime();">
		<header>
			<div class="time" id="txt"></div>
			<div class="time info">
				<?php
					$page = 'vupload.php';
					include('./session.php');
				?>
			</div>
			<img class='logo' height="30px" src="../pics/logo.png" />
			<h1>Stock One </h1>
		</header>
		<section>
			<div id="popup"></div>
			<div id="popupabout"></div>
			<?php
				// Enfin le script d'insertion de fichier, Je fais d'abord l'upload pour pouvoir les lire ensuite
				if(!isset($_POST['Public'])) { $publicstat = 'n'; } // C'est la valeur par défaut du fichier dans sa variable "public"
				else { $publicstat = 'y'; }
				
				if(!isset($_POST['option'])) {
					echo("> Importation d'un fichiers en cours...<br />");
					
					if(!isset($_FILES['fichiers'])) { echo("> Pas de fichiers détecter.<br />"); } // On check si il y a un fichiers ou pas
					else {
						$fichier = $_FILES['fichiers']['name'];
						$extension = strtolower(substr(strrchr($fichier, '.'), 1));
						$user = $_SESSION['user'];
						$path = "../files/$user/$fichier"; // Ce path est configuré pour la commande de déplacement
						
						$extensions_ok = array('jpg', 'jpeg', 'gif', 'png','bmp', 'pdf', 'odt', 'odp', 'txt', 'iso', 'py', 'php', 'pl', 'pa', 'sql', 'html', 'htm', 'xhtml', 'css', 'js', 'mp3');
						
						if(in_array($extension, $extensions_ok)) { echo("> Extension valide.<br />"); } // Une vérificatin d'extension que j'ai prévue de faire, je suis encore dessus
						
						// On le déplace vers le repertoire utilisateur
						$resultat = move_uploaded_file($_FILES['fichiers']['tmp_name'], $path);
						
						if($resultat) { // Et enfin on check si le transfert s'est bien passé puis on note la trace dans la db
							echo("> Transfert réussi.<br />");
							
							$taille = filesize("$path");
							$path = "./files/$user/"; // Ce path est le chemin de référence pour la database
							
							$req = $bdd->prepare('INSERT INTO donnee(identifiant, type, nom, nom_dossier, taille, public) VALUES(?, ?, ?, ?, ?, ?)');
							$req->execute(array($user, $extension, $fichier, $path, $taille, $publicstat));
							
							$req = $bdd->query('SELECT identifiant, nom, public FROM donnee');
							$data = $req->fetch();
							
							header('location: ../client.php');
						}
						else { echo("> Echec du transfert.<br />"); }
						
						// Voili voulou, j'espère que t'auras compris mon script Ugo, sur ceux @+
					}
				}
				else {
					echo("> Création d'un dossier en cours...");
					
					$user = $_SESSION['user'];
					$newelement = $_POST['Nom_Dossier'];
					$extension = 'folder';
					$path = "./files/$user/$newelement";
					
					$req = $bdd->prepare('INSERT INTO donnee(identifiant, type, nom, nom_dossier, public) VALUES(?, ?, ?, ?,?)');
					$req->execute(array($user, $extension, $newelement, $path, $publicstat));
					
					$path = "../files/$user/$newelement";
					mkdir($path);
					header('location: ../client.php');
				}
			?>
			<script type="text/javascript">
				popupaction(1, 1, 0);
			</script>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->