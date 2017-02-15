<!DOCTYPE html>
<!-- vupload.php -->
<html>
	<?php include('../bdd_access.php'); ?>
	<?php
		function list_fichiers($file, $dir) { // Fonction de listing de fichiers
			if($file[2] == 'folder') { echo(''); }
			else if($file[2] == 'png' || $file[2] == 'jpeg' || $file[2] == 'jpg' || $file[2] == 'gif' || $file[2] == 'bmp' ) { echo("<img class=\"classement\" height=\"15px\" src=\"../pics/".$dir."gallery.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 1, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
			else if($file[2] == 'mp3' || $file[2] == 'wav' || $file[2] == 'wma' || $file[2] == 'aac' || $file[2] == 'ac3' || $file[2] == 'm4a') { echo("<img class=\"classement\" height=\"15px\" src=\"../pics/".$dir."music.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 2, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
			else if($file[2] == 'txt' || $file[2] == 'log' || $file[2] == 'py' || $file[2] == 'pl' || $file[2] == 'js' || $file[2] == 'css' || $file[2] == 'php' || $file[2] == 'html' || $file[2] == 'sql' || $file[2] == 'pdf') { echo("<img class=\"classement\" height=\"15px\" src=\"../pics/".$dir."text-file.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 3, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
			else if($file[2] == 'mp4') { echo("<img class=\"classement\" height=\"15px\" src=\"../pics/".$dir."movie.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 4, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
			else { echo("<img class=\"classement\" height=\"15px\" src=\"../pics/".$dir."text-file.png\" /><a href=\"$file[4]$file[3]\" download><input class=\"list\" type=\"button\" value=\"$file[3]\" title=\"$file[3]\" /></a><br />"); }
		}
		
		function list_dossiers($file, $dir) { // Fonction de listing de dossiers
			if($file[2] == 'folder') { echo("<img class=\"classement\" height=\"15px\" src=\"../pics/".$dir."folder.png\" /><input class=\"list\" type=\"submit\" name=\"folder\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
			else { echo(''); }
		}
	?>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Listing de fichiers</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<?php if(isset($_SESSION['user'])) { include('./theme.php'); } ?>
	</head>
	<body>
		<form action="./filelist.php" method="get">
			<?php
				if(isset($_SESSION['user'])) {
					$user = $_SESSION['user'];
					$_SESSION['mode'] = 'admin';
				}
				else { header('location: ../#'); }
				
				if($_SESSION['profile'] != 'ADMIN') { header('location: ../client.php'); }
				
				echo('<input type="hidden" name="target" value="'.$_GET['target'].'" />');
				for($tour = 0; $tour < 2; $tour++) {
					$data = [$bdd->query('SELECT * FROM donnee'), $bdd->query('SELECT * FROM donnee'), $bdd->query('SELECT * FROM donnee')];
					
					switch($tour) {
						case 0:
							while($file = $data[0]->fetch()) {
								if($_GET['target'] == $file[1]) { list_dossiers($file, $dir); }
							} break;
						
						case 1:
							while($file = $data[0]->fetch()) {
								if($_GET['target'] == $file[1]) { list_fichiers($file, $dir); }
							} break;
					}
				}
			?>
		</form>
	</body>
</html>
<!-- END -->
