<?php
	// module.php
	// Fichier de fonction php
	function list_fichiers($file, $dir, $a) { // Fonction de listing de fichiers
		if($file[2] == 'folder') { echo(''); }
		else if($file[2] == 'png' || $file[2] == 'jpeg' || $file[2] == 'jpg' || $file[2] == 'gif' || $file[2] == 'bmp' ) { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."gallery.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 1, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
		else if($file[2] == 'mp3' || $file[2] == 'wav' || $file[2] == 'wma' || $file[2] == 'aac' || $file[2] == 'ac3' || $file[2] == 'm4a') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."music.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 2, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
		else if($file[2] == 'txt' || $file[2] == 'log' || $file[2] == 'py' || $file[2] == 'pl' || $file[2] == 'js' || $file[2] == 'css' || $file[2] == 'php' || $file[2] == 'html' || $file[2] == 'sql' || $file[2] == 'pdf') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."text-file.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 3, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
		else if($file[2] == 'mp4') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."movie.png\" /><input class=\"list\" type=\"button\" onclick=\"popupaction(4, '$file[4]$file[3]', 4, '$file[3]', '$file[5]', '$file[7]');\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
		else { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."text-file.png\" /><a href=\"$a$file[4]$file[3]\" download><input class=\"list\" type=\"button\" value=\"$file[3]\" title=\"$file[3]\" /></a><br />"); }
	}
	
	function list_dossiers($file, $dir, $a) { // Fonction de listing de dossiers
		if($file[2] == 'folder') { echo("<img class=\"classement\" height=\"15px\" src=\"$a./pics/".$dir."folder.png\" /><input class=\"list\" type=\"submit\" name=\"folder\" value=\"$file[3]\" title=\"$file[3]\" /><br />"); }
		else { echo(''); }
	}
	
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
	
	// END
?>
