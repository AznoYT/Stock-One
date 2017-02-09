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
				case 'default': $thumb = "#002200"; $rgb = "rgb(0,0,0)"; $rgb_r = "rgb(180,180,180)"; $border = "#CCCCCC"; $bgcolor = "#000000"; $bglist = "#333333"; $color = "#CCCCCC"; $actcolor = "#00FF00"; break;
				case 'reverse': $thumb = "#000000"; $rgb = "rgb(180,180,180)"; $rgb_r = "rgb(0,0,0)"; $border = "#000000"; $bgcolor = "#CCCCCC"; $bglist = "#999999"; $color = "#000000"; $actcolor = "#00AA00"; break;
				case 'red_line': $thumb = "#220000"; $rgb = "rgb(180,0,0)"; $rgb_r = "rgb(25,0,0)"; $border = "#CC0000"; $bgcolor = "#110000"; $bglist = "#330000"; $color = "#CC0000"; $actcolor = "#00FF00"; break;
				case 'green_line': $thumb = "#002200"; $rgb = "rgb(0,180,0)"; $rgb_r = "rgb(0,25,0)"; $border = "#00CC00"; $bgcolor = "#001100"; $bglist = "#003300"; $color = "#00CC00"; $actcolor = "#00FF00"; break;
				case 'blue_line': $thumb = "#002222"; $rgb = "rgb(0,180,180)"; $rgb_r = "rgb(0,25,25)"; $border = "#00CCCC"; $bgcolor = "#001111"; $bglist = "#003333"; $color = "#00CCCC"; $actcolor = "#00FF00"; break;
			}
		?>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<style>
			/* Thème: "<?php echo($_SESSION['theme']); ?>" */
			::-webkit-scrollbar { background-color: <?php echo("$bgcolor"); ?>; }
			::-webkit-scrollbar:horizontal { background-color: <?php echo("$bgcolor"); ?>; }
			::-webkit-scrollbar-track-piece { background-color: <?php echo("$bgcolor"); ?>; border: 1px solid <?php echo("$border"); ?>; }
			::-webkit-scrollbar-thumb { border: 1px solid <?php echo("$thumb"); ?>; -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb"); ?>, inset 0 0 0 .375em <?php echo("$rgb_r"); ?>; }
			::-webkit-scrollbar-thumb:hover { -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb"); ?>, inset 0 0 0 .375em <?php echo("$rgb"); ?>; }
			::-webkit-scrollbar-corner { background-color: <?php echo("$bgcolor"); ?>; }
			::-webkit-scrollbar-button { background-color: <?php echo("$bgcolor"); ?>; border: 1px solid <?php echo("$border"); ?>; }
			::-webkit-scrollbar-button:hover { -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb"); ?>, inset 0 0 0 .375em <?php echo("$rgb"); ?>; }
			userswitch-label { border: 2px solid <?php echo("$border"); ?>; border-radius: 50px; }
			.userswitch-inner:before, .userswitch-inner:after { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
			.userswitch-switch { background-color: <?php echo("$bgcolor"); ?>; border: 2px solid <?php echo("$border"); ?>; border-radius: 50px; }
			html, input { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
			input:hover { background-color: <?php echo("$color"); ?>; color: <?php echo("$bgcolor"); ?>; }
			.list:hover { background-color: <?php echo("$bglist"); ?>; color: <?php echo("$color"); ?>; }
			.controls:hover { background-color: <?php echo("$bglist"); ?>; color: <?php echo("$color"); ?>; }
			.modif, .modif:hover { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
			.ACT, #msg3 { color: <?php echo("$actcolor"); ?>; }
			.WARN:hover, .WARN:hover { color: <?php echo("$bgcolor"); ?>; }
			.ACT:hover { background-color: <?php echo("$actcolor"); ?>; }
			select { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
			select:hover { background-color: <?php echo("$bglist"); ?>; }
			fieldset { background-color: <?php echo("$bgcolor"); ?>; }
			.about, #popup, #popupabout, #progressbarControl { background-color: <?php echo("$bgcolor"); ?>; }
			#progressbar { background-color: <?php echo("$bglist"); ?>; }
			h2 { background-color: <?php echo("$color"); ?>; color: <?php echo("$bgcolor"); ?>; }
			a { color: <?php echo("$color"); ?>; }
			.profile:hover { background-color: <?php echo("$bglist"); ?>; }
			.volume { background-color: <?php echo("$bgcolor"); ?>; }
			.volume:hover { background-color: <?php echo("$bglist"); ?>; }
		</style>
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
						$data = [$bdd->query('SELECT * FROM donnee'), $data = $bdd->query('SELECT * FROM user')];
						$occupied_space = 0;
						
						while($file = $data[0]->fetch()) {
							if($file[1] == $user) { $occupied_space = $occupied_space + $file[5]; }
						}
						
						while($file = $data[1]->fetch()) {
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
								$l_theme = ['default','reverse','red_line','green_line','blue_line'];
								$n_theme = ['Par Défaut','Inverser','Ligne Rouge','Ligne Verte','Ligne Bleu'];
								
								for($i = 0; $i <= 4; $i++) {
									$select = NULL;
									if($_SESSION['theme'] == $l_theme[$i]) { $select = "selected"; }
									echo("<option value='".$l_theme[$i]."' ".$select.">".$n_theme[$i]."</option>");
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
