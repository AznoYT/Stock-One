<!DOCTYPE html>
<!-- action.php -->
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
					if(isset($_SESSION['user'])) {
						$user = $_SESSION['user'];
						$_SESSION['mode'] = 'admin';
						echo("<a class='profile' title='Retour à la Page Client' href='../client.php'><img class='avatar' height='25px' src='../pics/default/user.png' />$user</a>");
					}
					else { header('location: ../#'); }
				?>
			</div>
			<img class='logo' height="30px" src="../pics/logo.png" />
			<h1>Stock One </h1>
		</header>
		<section>
			<?php
				// Ce fichiers contiendra les commandes de suppressions et de copies
				include('./module.php'); // Appel de la fonction dans le fichier "module.php"
				
				$user = $_SESSION['user'];
				$fichiers = $_GET['fichiers'];
				$path = "../files/$user/$fichiers";
				
				if(!isset($_POST['to'])) { $pathpaste = NULL; }
				else { $pathpaste = "../files/$user/".$_POST['to']."/"; }
				
				echo("> fichiers à traiter: $path<br />");
				
				if(!isset($_POST['action'])) { // Si il s'est passé une couille encore, eh bah ça marque une erreur
					$code = "0";
					$etat = "ERREUR";
					echo("> Echec de traitement. #ERROR: COMMAND NON TROUVER");
				}
				else {
					switch($_POST['action']) {
						case 'Copier': $code = '0';
							echo("> Copie du fichier: $fichiers vers $pathpaste");
							$etat = action(0, $bdd, $user, $fichiers, $path, $pathpaste);
							break;
						case 'Déplacer': $code = '1';
							echo("> Déplacement du fichier: $fichiers vers $pathpaste");
							$etat = action(1, $bdd, $user, $fichiers, $path, $pathpaste);
							break;
						case 'Oui': $code = '2';
							echo("> Suppression du fichier: $fichiers");
							$etat = action(2, $bdd, $user, $fichiers, NULL, NULL);
							break;
						default: $code = '4';
							$etat = "INCONNU";
							echo("> Echec de traitement. #ERROR: COMMAND INCONNU");
							break;
					}
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