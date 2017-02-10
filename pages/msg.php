<?php
	// Fichier d'affichage de message de confirmation de commandes executé
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
