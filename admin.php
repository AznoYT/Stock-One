<!DOCTYPE html>
<!-- admin.php -->
<html>
	<?php
		session_start();
		try { $bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor'); }
		catch(Exception $e) { die('ERROR : '.$e->getMessage()); }
	?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Cloud [ADMIN MODE]</title>
		<?php
			switch($_SESSION['theme']) {
				case 'default': $dir = NULL; $thumb = "#002200"; $rgb = "rgb(0,0,0)"; $rgb_r = "rgb(180,180,180)"; $border = "#CCCCCC"; $bgcolor = "#000000"; $bglist = "#333333"; $color = "#CCCCCC"; $actcolor = "#00FF00"; break;
				case 'reverse': $dir = "reverse/"; $thumb = "#000000"; $rgb = "rgb(180,180,180)"; $rgb_r = "rgb(0,0,0)"; $border = "#000000"; $bgcolor = "#CCCCCC"; $bglist = "#999999"; $color = "#000000"; $actcolor = "#00AA00"; break;
				case 'red_line': $dir = NULL; $thumb = "#002200"; $rgb = "rgb(255,0,0)"; $rgb_r = "rgb(180,180,180)"; $border = "#CC0000"; $bgcolor = "#110000"; $bglist = "#330000"; $color = "#CC0000"; $actcolor = "#00FF00"; break;
				case 'red_line': $dir = NULL; $thumb = "#220000"; $rgb = "rgb(180,0,0)"; $rgb_r = "rgb(25,0,0)"; $border = "#CC0000"; $bgcolor = "#110000"; $bglist = "#330000"; $color = "#CC0000"; $actcolor = "#00FF00"; break;
				case 'green_line': $dir = NULL; $thumb = "#002200"; $rgb = "rgb(0,180,0)"; $rgb_r = "rgb(0,25,0)"; $border = "#00CC00"; $bgcolor = "#001100"; $bglist = "#003300"; $color = "#00CC00"; $actcolor = "#00FF00"; break;
				case 'blue_line': $dir = NULL; $thumb = "#002222"; $rgb = "rgb(0,180,180)"; $rgb_r = "rgb(0,25,25)"; $border = "#00CCCC"; $bgcolor = "#001111"; $bglist = "#003333"; $color = "#00CCCC"; $actcolor = "#00FF00"; break;
			}
		?>
		<link rel="stylesheet" type="text/css" href="./css/style.css" />
		<link rel="stylesheet" type="text/css" href="./css/scroll.css" />
		<link rel="icon" type="image/png" href="./pics/icon.png" />
		<style>
			/* Thème: "<?php echo($_SESSION['theme']); ?>" */
			::-webkit-scrollbar { background-color: <?php echo("$bgcolor"); ?>; }
			::-webkit-scrollbar:horizontal { background-color: <?php echo("$bgcolor"); ?>; }
			::-webkit-scrollbar-track-piece { background-color: <?php echo("$bgcolor"); ?>; border: 1px solid <?php echo("$border"); ?>; }
			::-webkit-scrollbar-thumb { border: 1px solid <?php echo("$thumb"); ?>; -webkit-box-shadow: inset 0 0 0 .0625em rgb(180,180,180), inset 0 0 0 .375em <?php echo("$rgb"); ?>; }
			::-webkit-scrollbar-thumb:hover { -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb_r"); ?>, inset 0 0 0 .375em <?php echo("$rgb_r"); ?>; }
			::-webkit-scrollbar-corner { background-color: <?php echo("$bgcolor"); ?>; }
			::-webkit-scrollbar-button { background-color: <?php echo("$bgcolor"); ?>; border: 1px solid <?php echo("$border"); ?>; }
			::-webkit-scrollbar-button:hover { -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb_r"); ?>, inset 0 0 0 .375em <?php echo("$rgb_r"); ?>; }
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
		<script language="javascript" type="text/javascript" src="./js/script.js"></script>
	</head>
	<body onload="startTime();">
		<header>
			<div class="time" id="txt"></div>
			<div class="time info">
				<?php
					if(isset($_SESSION['user'])) {
						$user = $_SESSION['user'];
						$_SESSION['mode'] = "admin";
						echo("<a class='profile' title='Paramètre du Compte Utilisateur' href='./pages/compteuser.php'><img class='avatar' height='25px' src='./pics/user.png' />$user</a>");
					}
					else { header("location: ./index.html"); }
					
					if($_SESSION['profile'] != "ADMIN") { header("location: ./index.html"); }
				?>
			</div>
			<div class="h-butons">
				<div class="userswitch">
					<input type="checkbox" name="userswitch" class="userswitch-checkbox" id="myuserswitch" onclick="adminswitch(2);" checked>
					<label class="userswitch-label" for="myuserswitch">
						<span class="userswitch-inner"></span>
						<span class="userswitch-switch"></span>
					</label>
				</div>
				<input class="color" type="button" value="Tchat" title="Faire apparaître le tchat IRC" onclick="popupaction(5);" />
				<input class="color" type="button" value="Créer un dossier" onclick="popupaction(3);" />
				<input class="color" type="button" value="Importer" onclick="popupaction(1, 0 , 0);" />
				<input class="color" type="button" value="Déconnexion" onclick="popupaction(2);" />
			</div>
			<img class='logo' height="30px" src="./pics/logo.png" />
			<h1>Stock One</h1>
		</header>
		<section>
			<aside id="admin_panel_left" class="left">
				<h2>Locations [./files/]</h2>
				<div class="content">
					<?php
						$data = [$bdd->query('SELECT * FROM user'), $bdd->query('SELECT * FROM donnee')];
						
						while($file = $data[0]->fetch()) {
							$data[1] = $bdd->query('SELECT * FROM donnee');
							$occupied_space = 0;
							
							while($file2 = $data[1]->fetch()) {
								if($file2[1] == $file[0]) {
									$occupied_space = $occupied_space + $file2[5];
									//$filediscover = ["'$file2[0]','$file2[1]','$file2[2]','$file2[3]','$file2[4]','$file2[5]','$file2[6]','$file2[7]'"];
								}
							}
							
							echo("<img class=\"classement\" height=\"15px\" src=\"./pics/".$dir."user.png\" /><input class=\"list\" type=\"button\" value=\"$file[0]\" title=\"$file[0]\" onclick=\"view_param(1, '$file[0]', '$file[1]', '$file[2]', '$file[3]', '$file[4]', '$file[5]', '$file[6]', '$file[7]', '$file[8]', '$occupied_space');\" /><br />");
						}
					?>
				</div>
			</aside>
			<aside class="admin_panel_right">
				<h2>Commandes</h2>
				<div id="frame_param">
					<div class="info_selected">
						<h3 id="selected">Affichage de: </h3>> 
						<input type="button" value="Données Utilisateurs" onclick="" />
						<input type="button" value="Paramètre Profile" onclick="" />
						<br /><br />
						<h3>Paramètre Afficher:</h3>
					</div>
					<div id="info_param">
						<p>Veuillez selectionnez un compte...</p>
					</div>
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
							case 4: $action = 'Importation'; $objet = 'fichier'; $directory = 'admin.php'; break;
							case 5: $action = 'Modification'; $objet = 'compte'; $directory = 'admin.php'; break;
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
