<!DOCTYPE html>
<!-- vupload.php -->
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
				if(!isset($_POST['Public'])) { // C'est la valeur par défaut du fichier dans sa variable "public"
					$publicstat = 'n';
				}
				else {
					$publicstat = 'y';
				}
				
				if(!isset($_FILES['fichiers'])) { // On check si il y a un fichiers ou pas
					echo("> Pas de fichiers détecter.");
				}
				else {
					$fichier = $_FILES['fichiers']['name'];
					$extension = strtolower(substr(strrchr($_FILES['fichiers']['name'], '.'), 1));
					$user = $_SESSION['user'];
					$path = "./files/$user/";
					$req = $bdd->prepare('INSERT INTO donnee(identifiant, type, nom, nom_dossier, public) VALUES(?, ?, ?, ?, ?)');
					$req->execute(array($_SESSION['user'], $extension, $_FILES['fichiers']['name'], $path, $publicstat));
					
					$req = $bdd->query('SELECT identifiant, nom, public FROM donnee');
					$data = $req->fetch();
					
					$extensions_ok = array('jpg', 'jpeg', 'gif', 'png','bmp', 'pdf', 'odt', 'odp', 'txt', 'iso', 'py', 'php', 'pl', 'pa', 'sql', 'html', 'htm', 'xhtml', 'css', 'js', 'mp3');
					$extension_upload = strtolower(substr(strrchr($_FILES['fichiers']['name'], '.'), 1));
					
					if(in_array($extension_upload, $extensions_ok)) { // Une vérificatin d'extension que j'ai prévue de faire, je suis encore dessus
						echo("> Extension valide.<br />");
					}
					
					// Une fois validé on le déplace vers le repertoire utilisateur
					$path = "../files/$user/$fichier";
					$resultat = move_uploaded_file($_FILES['fichiers']['tmp_name'], $path);
					
					if($resultat) { // Et enfin on check si le transfert s'est bien passé
						echo("> Transfert réussi.");
						header('location: ../client.php');
					}
					else {
						echo("> Echec du transfert.");
					}
					
					// Voili voulou, j'espère que t'auras compris mon script Ugo, sur ceux @+
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