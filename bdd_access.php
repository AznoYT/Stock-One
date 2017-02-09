<?php
	// bdd_access.php
	session_start();
	try { $bdd = new PDO('mysql:host=127.0.0.1;dbname=stock-one;charset=utf8', 'root', 'toor', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
	catch(Exception $e) { die('ERROR : '.$e->getMessage()); }
	// END
?>
