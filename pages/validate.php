<!DOCTYPE html>
<!-- validate.php -->
<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="icon" type="image/png" href="../image/cloud.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
		}
		catch(Exception $e) {
			die('ERROR : '.$e->getMessage());
		}
	?>
	<body>
		<header>
			<h1>Stock One</h1>
		</header>
		<section>
			<div id="popup">
				
			</div>
			<?php
				$rusr = $_POST['utilisateur'];
				$pass = $_POST['pws'];
				$name = $_POST['Nom'];
				$subname = $_POST['prenom'];
				$sexe = $_POST['genre'];
				$mail = $_POST['email'];
				$PROFILE = 'USER';
				
				if(!isset($_POST['notif'])) {
					$notif = 'n';
				}
				else {
					$notif = 'y';
				}
				if(!isset($_POST['notifpart'])) {
					$notifpart = 'n';
				}
				else {
					$notifpart = 'y';
				}
				
				echo("<p>Les informations suivants sont en cours de traitement: <p><br/><br/>");
				echo("<p>> Nom d'utilisateur: $rusr <br/>");
				echo("<p>> Nom: $name <br/>");
				echo("<p>> Prénom: $subname <br/>");
				echo("<p>> Votre sexe: $sexe <br/>");
				echo("<p>> Votre addresse mail: $mail <br/>");
				echo("<p>> Recevoir des notification de So: $notif <br/>");
				echo("<p>> Avoir contact avec les partenaires de So: $notifpart <br/></p>");
				
				$login = $bdd->query('SELECT * FROM user');
				$try = 0;
				
				while($usr = $login->fetch()) {
					if($rusr == $usr[0]) {
						$try = 1;
					}
				}
				if($try == 1) {
					echo("<br />> Echec de la tentative de creation de compte.");
				}
				else {
					$_SESSION['user'] = $_POST['utilisateur'];
					
					//Insertion des informations dans la base de données
					$stmt = $bdd->prepare('INSERT INTO user(utilisateur, pws, nom, prenom, genre, email, notifso, notifpartenaire, GRADE) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)');
					$stmt->execute(array($_POST['utilisateur'], $_POST['pws'], $_POST['Nom'], $_POST['prenom'], $_POST['genre'], $mail = $_POST['email'], $notif, $notifpart, $PROFILE));
					$stmt = $bdd->query('SELECT utilisateur FROM user');
					// Et enfin création du répertoires de stockage de l'utilisateur
					mkdir("../files/$rusr");
					
					header("location: ../client.php");
				}
				$bdd = null;
			?>
			<script type="text/javascript">
				popuplogin(2, 1);
				verify(2, 1, 1, 0);
				document.getElementById('userinput').value = "<?php echo($rusr); ?>";
			</script>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
