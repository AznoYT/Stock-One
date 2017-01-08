<!DOCTYPE html>
<!-- IRC.php -->
<?php session_start() ?>
<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../css/irc.css" />
		<link rel="stylesheet" type="text/css" href="../css/scroll.css" />
		<script language="javascript" type="text/javascript" src="../js/script.js"></script>
	</head>
	<body>
		<div class="tchat">
			<div class="title">
				<h3>Chat IRC <?php if($_SESSION['mode'] == "admin") {echo("[ADMIN MOD]");} ?></h3>
			</div>
			<?php
				if(isset($_SESSION['user'])) {
					$user = $_SESSION['user'];
					$_SESSION['mode'] = "client";
				}
				else {
					header("location: ../index.html");
				}
			?>
			<div class="tchat_body">
				<div id="tchat_area">
					<?php
						$user = $_SESSION['user'];
						
						if($user != "admin" || $_SESSION['mode'] == "client") {
							$user = 'primary';
						}
						else if($user == "admin") {
							if($_SESSION['mode'] == "admin") {
								$user = "admin";
							}
						}
						
						$history = fopen('../pages/historiques-IRC/history-'.$user.'.htm', 'r+');
						$frame = fgets($history);
						
						if(!isset($_POST['message'])) {
							echo("");
						}
						else if($_POST['message']) {
							$msg = $_POST['message'];
							if($msg == "Ecrivez votre message...") {
								echo("");
							}
							else {
								$user = $_SESSION['user'];
								$sending = '> '.$user.': '.$msg.'<br />';
								fputs($history, $sending);
								$frame = $frame.$sending;
							}
						}
						
						echo($frame);
						fclose($history);
					?>
				</div>
				<div class="tchat_entry">
					<form method="post" action="#">
						<input type="text" id="text_input" name="message" value="Ecrivez votre message..." onfocus="info_tchat(1, this.value);" onblur="info_tchat(1, this.value);" />
						<input type="submit" value="Envoyer" />
					</form>
				</div>
				<script language="javascript" type="text/javascript">
					element = document.getElementById('tchat_area');
					element.scrollTop = element.scrollHeight;
					document.getElementById('text_input').focus();
				</script>
			</div>
		</div>
	</body>
</html>
<!-- END -->
