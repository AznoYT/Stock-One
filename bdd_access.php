<?php
	// bdd_access.php
	$host = '127.0.0.1';
	$db_name = 'stock-one';
	$encoding = 'utf8';
	$username = 'root';
	$password = 'toor';
	
	session_start();
	try { $bdd = new PDO('mysql:host='.$host.';dbname='.$db_name.';charset='.$encoding, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); }
	catch(Exception $e) { die('ERROR : '.$e->getMessage()); }
	// END
?>
