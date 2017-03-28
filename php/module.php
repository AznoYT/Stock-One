<?php
	// module.php
	// Fichier de fonction php
	
	// Fonction de listing de fichiers
	function list_fichiers($file, $dir, $a, $i, $link) {
		echo("<div onmouseover=\"option(1, 1, 'list_$i');\" onmouseout=\"option(1, 0, 'list_$i');\">");
		if($file[2] == 'folder') { echo(''); }
		else if($file[2] == 'png' || $file[2] == 'jpeg' || $file[2] == 'jpg' || $file[2] == 'gif' || $file[2] == 'bmp' ) { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."gallery.png\" /><input class=\"list\" id=\"list_$i\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 1, '$file[3]', '$file[5]', '$file[7]', '$file[2]','".$_SESSION['user']."');\" value=\"$file[3]\" title=\"$file[3]\" />"); }
		else if($file[2] == 'mp3' || $file[2] == 'wav' || $file[2] == 'wma' || $file[2] == 'aac' || $file[2] == 'ac3' || $file[2] == 'm4a') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."music.png\" /><input class=\"list\" id=\"list_$i\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 2, '$file[3]', '$file[5]', '$file[7]', '$file[2]','".$_SESSION['user']."');\" value=\"$file[3]\" title=\"$file[3]\" />"); }
		else if($file[2] == 'txt' || $file[2] == 'log' || $file[2] == 'py' || $file[2] == 'pl' || $file[2] == 'js' || $file[2] == 'css' || $file[2] == 'php' || $file[2] == 'html' || $file[2] == 'pdf') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."text-file.png\" /><input class=\"list\" id=\"list_$i\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 3, '$file[3]', '$file[5]', '$file[7]', '$file[2]', '".$_SESSION['user']."');\" value=\"$file[3]\" title=\"$file[3]\" />"); }
		else if($file[2] == 'mp4') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."movie.png\" /><input class=\"list\" id=\"list_$i\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 4, '$file[3]', '$file[5]', '$file[7]', '$file[2]', '".$_SESSION['user']."');\" value=\"$file[3]\" title=\"$file[3]\" />"); }
		else { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."text-file.png\" /><a href=\"$a$file[4]$file[3]\" download><input class=\"list\" id=\"list_$i\" type=\"button\" value=\"$file[3]\" title=\"$file[3]\" /></a>"); }
		
		if($link == 1) { $link = '.'; }
		else { $link = ''; }
		
		if($file[2] != 'folder') { echo("<input class=\"list opt\" type=\"button\" value=\">\" onclick=\"option(2, 0, 'opt_$i', '$link$file[4]$file[3]', '$file[3]', theme, '$file[5]', '$file[7]', '$file[2]', '".$_SESSION['user']."');\" /><nav id=\"opt_$i\"></nav><br />"); }
		echo("</div>");
	}
	
	// Fonction de listing de dossiers
	function list_dossiers($file, $dir, $a, $i, $link) {
		echo("<div onmouseover=\"option(1, 1, 'list_$i');\" onmouseout=\"option(1, 0, 'list_$i');\">");
		if($file[2] == 'folder') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."folder.png\" /><input class=\"list\" id=\"list_$i\" type=\"submit\" name=\"folder\" value=\"$file[3]\" title=\"$file[3]\" />"); }
		else { echo(''); }
		
		if($link == 1) { $link = '.'; }
		else { $link = ''; }
		
		if($file[2] == 'folder') { echo("<input class=\"list opt\" type=\"button\" value=\">\" onclick=\"option(2, 0, 'opt_$i', '$link$file[4]', '$file[3]', theme);\" /><nav id=\"opt_$i\"></nav><br />"); }
		echo("</div>");
	}
	
	// Fonction de commande Copie/Déplacement/Suppression de fichiers
	function action($COMMAND, $db, $propriétaire, $nom, $dir, $dirpaste) {
		// Dans la fonction il y aura le mode d'action de donnée dans la database. Elle sera ensuite appeler par chaque conditions
		switch($COMMAND) {
			case 0: break; // Copie sur serveur
			case 1: break; // Déplacement sur serveur
			case 2: unlink($dir); break; // Suppression du serveur
			case 3: break; // Renommage du fichier dans le serveur
		}
		
		// Cette Partie du code concerne le référencement dans la base donnée
		$data = $db->query('SELECT * FROM donnee');
		
		while($file = $data->fetch()) {
			if($propriétaire == $file[1]) {
				if($nom == $file[3]) {
					switch($COMMAND) {
						case 0: $stmt = $db->prepare('INSERT INTO donnee(identifiant, type, nom, nom_dossier, taille, public) VALUES ("'.$propriétaire.'", "'.$file[2].'", "'.$nom.'", "'.$file[4].'", "'.$file[5].'", "'.$file[7].'")'); break; // La copie
						case 1: $stmt = $db->prepare('UPDATE donnee SET nom_dossier'); break; // Le déplacement
						case 2: $stmt = $db->prepare('DELETE FROM donnee WHERE nom="'.$nom.'"'); break; // La suppression
						case 3: $stmt = $db->prepare('UPDATE donnee SET nom="'.$dirpaste.'" WHERE nom="'.$nom.'" AND identifiant="'.$propriétaire.'"'); break; // Le renommage
					}
					
					$stmt->execute();
				}
			}
		}
		
		return 'OK';
	}
	
	// Fonction de mise à jour d'état de partage d'un fichier
	function share_state($db, $state, $file, $user) {
		$data = $db->query('SELECT * FROM donnee');
		
		while($nom = $data->fetch()) {
			if($nom[1] == $user) {
				if($nom[3] == $file) {
					$stmt = $db->prepare('UPDATE donnee SET public="'.$state.'" WHERE nom="'.$file.'" AND identifiant="'.$user.'"');
					$stmt->execute();
					echo("<script>document.location = './client.php';</script>");
				}
			}
		}
	}
	
	// END
?>
