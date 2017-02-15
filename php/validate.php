<!DOCTYPE html>
<!-- validate.php -->
<html>
	<?php include('./bdd_access.php'); ?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<link rel="stylesheet" type="text/css" href="../css/system.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body onload="startTime();">
		<header>
			<div class="time" id="txt"></div>
			<a title="Retour à la Page d'Accueil" href="../#">
				<img class='logo' height="30px" src="../pics/logo.png" />
				<h1>Stock One</h1>
			</a>
		</header>
		<section>
			<div id="popup"></div>
			<?php
				if($_POST['method'] == 'REGISTER') { // Ici le script d'enregistrement du compte (REGISTER)
					$username = $_POST['utilisateur'];
					$name = $_POST['Nom'];
					$subname = $_POST['prenom'];
					$sexe = $_POST['genre'];
					$mail = $_POST['email'];
					$PROFILE = 'USER';
					$methode = 2;
					$verify = '2, 1, 1, 0';
					
					if(!isset($_POST['notif'])) { $notif = 'n'; }
					else { $notif = 'y'; }
					if(!isset($_POST['notifpart'])) { $notifpart = 'n'; }
					else { $notifpart = 'y'; }
					
					echo("<p>Les informations suivants sont en cours de traitement: <p><br/><br/>");
					echo("<p>> Nom d'utilisateur: $username <br/>");
					echo("<p>> Nom: $name <br/>");
					echo("<p>> Prénom: $subname <br/>");
					echo("<p>> Votre sexe: $sexe <br/>");
					echo("<p>> Votre addresse mail: $mail <br/>");
					echo("<p>> Recevoir des notification de So: $notif <br/>");
					echo("<p>> Avoir contact avec les partenaires de So: $notifpart <br/></p>");
					
					$login = $bdd->query('SELECT * FROM user');
					$try = 0;
					
					while($usr = $login->fetch()) {
						if($username == $usr[0]) { $try = 1; }
					}
					
					switch($try) {
						case 1: echo('<br />> Echec de la tentative de creation de compte.'); break;
						default: $_SESSION['user'] = $_POST['utilisateur'];
							$_SESSION['profile'] = $PROFILE;
							
							// Insertion des informations dans la base de données
							$stmt = $bdd->prepare('INSERT INTO user(utilisateur, pws, nom, prenom, genre, email, notifso, notifpartenaire, GRADE) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
							$stmt->execute(array($_POST['utilisateur'], $_POST['pws'], $_POST['Nom'], $_POST['prenom'], $_POST['genre'], $mail = $_POST['email'], $notif, $notifpart, $PROFILE));
							$stmt = $bdd->query('SELECT utilisateur FROM user');
							// Et enfin création du répertoires de stockage de l'utilisateur
							mkdir("../files/$username");
							
							header('location: ../client.php');
							break;
					}
					
					$bdd = NULL;
				}
				else if($_POST['method'] == 'LOGIN') { // Ici le script de connexion au compte (LOGIN)
					$login = $bdd->query('SELECT * FROM user');
					$username = $_POST['lutilisateur'];
					$lpws = $_POST['lpws'];
					$try = 0;
					$methode = 1;
					$verify = '1, 1, 0';
					
					while($usr = $login->fetch()) {
						if($username == $usr[0]) {
							if($lpws == $usr[5]) {
								$try = 1;
								$_SESSION['user'] = $_POST['lutilisateur'];
								$_SESSION['profile'] = $usr[8];
								$_SESSION['theme'] = $usr[9];
								
								header('location: ../client.php');
							}
						}
					}
					
					if($try == 0) { echo('> Echec de la tentative de connexion.'); }
					
					$bdd = NULL;
				}
			?>
			<script type="text/javascript">
				popuplogin(<?php echo($methode); ?>, 1);
				verify(<?php echo("$verify"); ?>);
				document.getElementById('userinput').value = "<?php echo($username); ?>";
			</script>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
