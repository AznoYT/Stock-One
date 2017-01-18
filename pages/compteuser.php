<!DOCTYPE html>
<!-- compteuser.php -->
<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud [Compte Utilisateur]</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<?php
		try {
			$bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor');
		}
		catch(Exception $e) {
			die('ERROR : '.$e->getMessage());
		}
	?>
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
					else {
						header("location: ../index.html");
					}
				?>
			</div>
			<div class="h-butons">
				<input class="color" type="button" value="Tchat" title="Faire apparaître le tchat IRC" onclick="popupaction(5, 0);" />
				<input class="color" type="button" value="Déconnexion" onclick="popupaction(2, 1);" />
			</div>
			<img class='logo' height="30px" src="../pics/logo.png" />
			<h1>Stock One</h1>
		</header>
		<section>
			<aside id="admin_panel_left" class="left">
				<h2>Vos Informations</h2>
				<div class="content">
					<?php
						$data = $bdd->query('SELECT * FROM user');
						
						while($file = $data->fetch()) {
							if($file[0] == $user) {
								echo("<label>--- Votre Identifiant:</label>
								<br />
								- $file[0] <font id='msg0'>[Non Modifiable]</font>
								<br /><br />
								<label>--- Votre Nom:</label>
								<br />
								- $file[1]
								<br /><br />
								<label>--- Votre Prénom:</label>
								<br />
								- $file[2]
								<br /><br />
								<label>--- Votre Sexe:</label>
								<br />
								- $file[3] <font id='msg0'>[Non Modifiable]</font>
								<br /><br />
								<label>--- Votre Adresse Mail:</label>
								<br />
								- $file[4]
								<br /><br />
								<label>--- Votre Grade:</label>
								<br />
								- $file[8]");
							}
						}
					?>
				</div>
			</aside>
			<aside class="admin_panel_right">
				<h2>Modification compte utilisateur</h2>
				<div class="content">
					<form action="./verifmcompte.php" method="POST" onsubmit="return verify(1, this.pws1, this.pws2, 'confirm');" style="padding: 4px;">
						<h3>Modification Informations Personnels: </h3><font id="msg3">[Laisser vide pour ne pas modifier]</font>
						<br /><br />
						<label>> Votre Nom:</label>
						<input type="text" class="modif" name="mnom" />
						<br />
						<label>> Votre Prénom:</label>
						<input type="text" class="modif" name="mprenom" />
						<br />
						<label>> Votre Email:</label>
						<input type="email" class="modif" name="memail" />
						<br /><br /><br />
						<h3>Modification Mot de passe: </h3>
						<br />
						<label>> Votre Nouveaux mot de passe:</label>
						<input type="password" class="modif" name="pws1" />
						<font id="msg1"></font>
						<br />
						<label>> Resaissir son mot de passe:</label>
						<input type="password" class="modif" name="pws2" />
						<font id="msg2"></font>
						<br /><br />
						<input type="submit" class="ACT" value="Modifier" title="Modifier les Informations du Compte" />
						<input class="WARN" type="reset" value="Tout Effacer" />
						<input type="button" class="color" value="Retour" onclick="document.location = '../client.php'" />
					</form>
				</div>
			</aside>
			<div id="popup">
				
			</div>
			<div id="popupabout">
				<?php
					if(!isset($_GET['code'])) {
						echo("");
					}
					else {
						if($_GET['code'] == '1') {
							$action = 'Copie';
							$objet = 'fichier';
							$directory = 'client.php';
						}
						else if($_GET['code'] == '2') {
							$action = 'Déplacement';
							$objet = 'fichier';
							$directory = 'client.php';
						}
						else if($_GET['code'] == '3') {
							$action = 'Suppression';
							$objet = 'fichier';
							$directory = 'client.php';
						}
						else if($_GET['code'] == '4') {
							$action = 'Importation';
							$objet = 'fichier';
							$directory = 'compteuser.php';
						}
						else if($_GET['code'] == '5') {
							$action = 'Modification';
							$objet = 'compte';
							$directory = 'compteuser.php';
						}
						
						if($_GET['etat'] == "OK") {
							$msg = '<font id="msg3">> L\'action mené au '.$objet.' à bien été éxecuter.</font>';
						}
						else if($_GET['etat'] == "ERREUR") {
							$msg = '<font id="msg0">> L\'action mené au '.$objet.' fichier à rencontrer une erreur.</font>';
						}
						
						echo("<fieldset>");
						echo("<Legend>Confirmation de $action:</Legend>");
						echo($msg);
						echo("<br /><br />");
						echo('<input type="button" onclick="moreaction(0); document.location = \'./'.$directory.'\';" value="Fermer" />');
						echo("</fieldset>");
					}
				?>
			</div>
		</section>
		<footer>
			<h4>Auteur: Groupe STI2D SIN Déodat de Séverac - 2016 Novembre</h4>
		</footer>
		<div id="popup_irc"></div>
	</body>
</html>
<!-- END -->
