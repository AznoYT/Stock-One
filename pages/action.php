<!DOCTYPE html>
<!-- action.php -->
<html>
	<?php
		session_start();
		try { $bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
		catch(Exception $e) { die('ERROR : '.$e->getMessage()); }
	?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
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
						$_SESSION['mode'] = "admin";
						echo("<a class='profile' title='Retour à la Page Client' href='../client.php'><img class='avatar' height='25px' src='../pics/user.png' />$user</a>");
					}
					else { header("location: ../index.html"); }
				?>
			</div>
			<img class='logo' height="30px" src="../pics/logo.png" />
			<h1>Stock One </h1>
		</header>
		<section>
			<?php
				// Ce fichiers contiendra les commandes de suppressions et de copies
				function action($COMMAND, $db, $propriétaire, $nom, $dir, $dirpaste) {
					// Dans la fonction il y aura le mode d'action de donnée dans la database. Elle sera ensuite appeler par chaque conditions
					// ICI sera insérer le code PHP executant l'action sur le fichier choisi
					
					
					// Cette Partie du code concerne le référencement dans la base donnée
					$data = $db->query('SELECT * FROM donnee');
					
					while($file = $data->fetch()) {
						if($propriétaire == $file[1]) {
							if($nom == $file[3]) {
								switch($COMMAND) {
									case 0: $stmt = $db->prepare('INSERT INTO donnee(identifiant, type, nom, nom_dossier, taille, public) VALUES ("'.$propriétaire.'", "'.$file[2].'", "'.$nom.'", "'.$file[4].'", "'.$file[5].'", "'.$file[7].'")'); break; // La copie
									case 1: $stmt = $db->prepare('UPDATE donnee SET nom_dossier'); break; // Le déplacement
									case 2: $stmt = $db->prepare('DELETE FROM donnee WHERE nom="'.$nom.'"'); break; // La suppression
								}
								
								$stmt->execute();
							}
						}
					}
					
					return 'OK';
				}
				
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
						case 'Copier': $code = "1";
							echo("> Copie du fichier: $fichiers vers $pathpaste");
							$etat = action(0, $bdd, $user, $fichiers, $path, $pathpaste);
							break;
						case 'Déplacer': $code = "2";
							echo("> Déplacement du fichier: $fichiers vers $pathpaste");
							$etat = action(1, $bdd, $user, $fichiers, $path, $pathpaste);
							break;
						case 'Oui': $code = "3";
							echo("> Suppression du fichier: $fichiers");
							$etat = action(2, $bdd, $user, $fichiers, NULL, NULL);
							break;
						default: $code = "0";
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