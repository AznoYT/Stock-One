<!DOCTYPE html>
<!-- upload.php -->
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
					<legend>Envoyer le fichier :</legend><br>
						<input name="file" type="file" /><br><br>
						<input type="checkbox" name="" value="notif">
						<label>Public</label><br/>
						<input type="checkbox" name="Privee" value="notifpart">
						<label>Public</label><br/><br/>
						<input type="submit" name="submit" value="Uploader" />
				</fieldset>
			</form>
		</section>
		<footer>
			<h4></h4>
		</footer>
	</body>
</html>
<!-- END -->
