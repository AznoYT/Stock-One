<!DOCTYPE html>
<!-- compteuser.php -->
<html>
	<?php
		session_start();
		try { $bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor'); }
		catch(Exception $e) { die('ERROR : '.$e->getMessage()); }
	?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud [Compte Utilisateur]</title>
		<?php
			if(!isset($_POST['theme'])) { echo(""); }
			else {
				$_SESSION['theme'] = $_POST['theme'];
				$stmt = $bdd->prepare('UPDATE user SET theme="'.$_POST['theme'].'" WHERE utilisateur="'.$_SESSION['user'].'"');
				$stmt->execute();
			}
			switch($_SESSION['theme']) {
				case 'default': echo("<link rel='stylesheet' type='text/css' href='../css/style.css' /><link rel='stylesheet' type='text/css' href='../css/scroll.css' />"); break;
				case 'reverse': echo("<link rel='stylesheet' type='text/css' href='../css/reverse/style.css' /><link rel='stylesheet' type='text/css' href='../css/reverse/scroll.css' />"); break;
			}
		?>
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
						$data = $bdd->query('SELECT * FROM donnee');
						$occupied_space = 0;
						
						while($file = $data->fetch()) {
							if($file[1] == $user) { $occupied_space = $occupied_space + $file[5]; }
						}
						
						$data = $bdd->query('SELECT * FROM user');
						
						while($file = $data->fetch()) {
							if($file[0] == $user) {
								echo("<label>--- Votre Identifiant:</label><br />
								- $file[0] <font id='msg0'>[Non Modifiable]</font>
								<br /><br />
								<label>--- Votre Nom:</label><br />
								- $file[1]
								<br /><br />
								<label>--- Votre Prénom:</label><br />
								- $file[2]
								<br /><br />
								<label>--- Votre Sexe:</label><br />
								- $file[3] <font id='msg0'>[Non Modifiable]</font>
								<br /><br />
								<label>--- Votre Adresse Mail:</label><br />
								- $file[4]
								<br /><br />
								<label>--- Votre Grade:</label><br />
								- $file[8]
								<br /><br /><br />
								<label>--- Votre Espace disque:</label>
								<br /><br />
								<center>
									<div id='progressbarControl' style='margin-left: 15px; margin-right: 15px; width: auto;'>
										<div id='progressbar'>
											<script language='javascript' type='text/javascript'>
												analysedisk($occupied_space);
											</script>
										</div>
									</div>
								</center>
								");
							}
						}
					?>
				</div>
			</aside>
			<aside class="admin_panel_right">
				<h2>Paramètres</h2>
				<div class="content">
					<form action="./verifmcompte.php" method="POST" onsubmit="return verify(1, this.pws1, this.pws2, 'confirm');" style="padding: 4px;">
						<h3>Modification Informations Personnels: </h3><font id="msg3">[Laisser vide pour ne pas modifier]</font>
						<br /><br />
						<label for="nom">> Votre Nom:</label>
						<input type="text" id="nom" class="modif" name="mnom" />
						<br />
						<label for="prenom">> Votre Prénom:</label>
						<input type="text" id="prenom" class="modif" name="mprenom" />
						<br />
						<label for="email">> Votre Email:</label>
						<input type="email" id="email" class="modif" name="memail" />
						<br /><br /><br />
						<h3>Modification Mot de passe: </h3>
						<br />
						<label for="password">> Votre Nouveaux mot de passe:</label>
						<input type="password" id="password" class="modif" name="pws1" />
						<font id="msg1"></font>
						<br />
						<label for="cpassword">> Resaissir son mot de passe:</label>
						<input type="password" id="cpassword" class="modif" name="pws2" />
						<font id="msg2"></font>
						<br /><br />
						<input type="submit" class="ACT" value="Modifier" title="Modifier les Informations du Compte" />
						<input class="WARN" type="reset" value="Tout Effacer" />
						<input type="button" class="color" value="Retour" onclick="document.location = '../client.php'" />
					</form>
					<br /><br />
					<form action method="post" style="padding: 4px;">
						<h3>Modification du Thème:</h3>
						<br />
						<label>> Thème: </label>
						<select id="theme" name="theme">
							<?php
								switch($_SESSION['theme']) {
									case 'default': echo("<option value='default'>Par Défaut</option>");
										echo("<option value='reverse'>Inverser</option>");
										break;
									case 'reverse': echo("<option value='reverse'>Inverser</option>");
										echo("<option value='default'>Par Défaut</option>");
										break;
								}
							?>
						</select>
						<br /><br />
						<input type="submit" class="ACT" value="Modifier" title="Modifier les Informations du Compte" />
					</form>
				</div>
			</aside>
			<div id="popup"></div>
			<div id="popupabout">
				<?php
					if(!isset($_GET['code'])) { echo(""); }
					else {
						switch($_GET['code']) {
							case 1: $action = 'Copie'; $objet = 'fichier'; $directory = 'client.php'; break;
							case 2: $action = 'Déplacement'; $objet = 'fichier'; $directory = 'client.php'; break;
							case 3: $action = 'Suppression'; $objet = 'fichier'; $directory = 'client.php'; break;
							case 4: $action = 'Importation'; $objet = 'fichier'; $directory = 'compteuser.php'; break;
							case 5: $action = 'Modification'; $objet = 'compte'; $directory = 'compteuser.php'; break;
						}
						
						switch($_GET['etat']) {
							case 'OK': $msg = '<font id="msg3">> L\'action mené au '.$objet.' à bien été éxecuter.</font>'; break;
							case 'ERREUR': $msg = '<font id="msg0">> L\'action mené au '.$objet.' fichier à rencontrer une erreur.</font>'; break;
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
