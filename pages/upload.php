<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Stock One - Upload</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body>
		<header>
			<h1>Stock One </h1>
		</header>
		<section>
			<form method="post" action="vupload.php">
				<fieldset>
					<legend>Envoyer le fichier :</legend><br><br>
						<input name="fichier" type="file" /><br><br>
						<input type="checkbox" name="public" value="notif"> Public <br>
						<input type="checkbox" name="Privee" value="notifpart"> Privée<br><br>
						<input type="submit" name="submit" value="Uploader" />
				</fieldset>
			</form>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
