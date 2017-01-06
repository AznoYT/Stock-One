<!DOCTYPE html>
<!-- veriflogin.php -->
<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Validation Connexion</title>
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
			<h1>Stock One </h1>
		</header>
		<section>
			<div id="popup">
				
			</div>
			<?php
				$login = $bdd->query('SELECT * FROM user');
				$lusr = $_POST['lutilisateur'];
				$lpws = $_POST['lpws'];
				$try = 0;
				
				while($usr = $login->fetch()) {
					if($lusr == $usr[0]) {
						if($lpws == $usr[5]) {
							$try = 1;
							$_SESSION['user'] = $_POST['lutilisateur'];
							if($usr[8] == 'ADMIN') {
								$_SESSION['profile'] = $usr[8];
								header("location: ../admin.php");
							}
							else if($usr[8] == 'USER') {
								$_SESSION['profile'] = $usr[8];
								header("location: ../client.php");
							}
						}
					}
				}
				if($try == 0) {
					echo("> Echec de la tentative de connexion.");
				}
				$bdd = null;
			?>
			<script type="text/javascript">
				popuplogin(1, 1);
				verify(1, 1, 0);
				document.getElementById('userinput').value = "<?php echo($lusr); ?>";
			</script>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
