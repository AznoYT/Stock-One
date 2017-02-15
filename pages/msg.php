<?php
	// Fichier d'affichage de message de confirmation de commandes executé
	$frame0 = ['Copie', 'Déplacement', 'Suppression', 'Importation', 'Modification'];
	$frame1 = ['fichier', 'fichier', 'fichier', 'fichier', 'compte'];
	$action = $frame0[$_GET['code']]; $objet = $frame1[$_GET['code']]; $directory = $frame2[$_GET['code']];
	
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
?>
