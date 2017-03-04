<!DOCTYPE html>
<!-- other.php -->
<?php session_start(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Other Programme</title>
		<link rel='stylesheet' type='text/css' href='../css/other.css' />
		<link rel="icon" type="image/png" href="../pics/icon.png" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
		<script language="javascript" type="text/javascript" src="../js/other.js"></script>
	</head>
	<?php
		if(isset($_SESSION['user'])) { echo(''); }
		else { header('location: ../#'); }
	?>
	<script>
		launch();
	</script>
</html>
<!-- END -->
