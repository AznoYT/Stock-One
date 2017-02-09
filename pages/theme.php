<!-- theme.php -->
<?php
	switch($_SESSION['theme']) {
		case 'default': $dir = 'default/'; $thumb = "#002200"; $rgb = "rgb(0,0,0)"; $rgb_r = "rgb(180,180,180)"; $border = "#CCCCCC"; $bgcolor = "#000000"; $bglist = "#333333"; $color = "#CCCCCC"; $actcolor = "#00FF00"; $stick1 = "#888888"; $stick2 = "#999999"; $stick3 = "#AAAAAA"; $stick4 = "#BBBBBB"; $stick5 = "#CCCCCC"; break;
		case 'reverse': $dir = 'reverse/'; $thumb = "#000000"; $rgb = "rgb(180,180,180)"; $rgb_r = "rgb(0,0,0)"; $border = "#000000"; $bgcolor = "#CCCCCC"; $bglist = "#999999"; $color = "#000000"; $actcolor = "#00AA00"; $stick1 = "#444444"; $stick2 = "#333333"; $stick3 = "#222222"; $stick4 = "#111111"; $stick5 = "#000000"; break;
		case 'red_line': $dir = 'default/'; $thumb = "#220000"; $rgb = "rgb(180,0,0)"; $rgb_r = "rgb(25,0,0)"; $border = "#CC0000"; $bgcolor = "#110000"; $bglist = "#330000"; $color = "#CC0000"; $actcolor = "#00FF00"; $stick1 = "#880000"; $stick2 = "#990000"; $stick3 = "#AA0000"; $stick4 = "#BB0000"; $stick5 = "#CC0000"; break;
		case 'green_line': $dir = 'default/'; $thumb = "#002200"; $rgb = "rgb(0,180,0)"; $rgb_r = "rgb(0,25,0)"; $border = "#00CC00"; $bgcolor = "#001100"; $bglist = "#003300"; $color = "#00CC00"; $actcolor = "#00FF00"; $stick1 = "#008800"; $stick2 = "#009900"; $stick3 = "#00AA00"; $stick4 = "#00BB00"; $stick5 = "#00CC00"; break;
		case 'blue_line': $dir = 'default/'; $thumb = "#002222"; $rgb = "rgb(0,180,180)"; $rgb_r = "rgb(0,25,25)"; $border = "#00CCCC"; $bgcolor = "#001111"; $bglist = "#003333"; $color = "#00CCCC"; $actcolor = "#00FF00"; $stick1 = "#008888"; $stick2 = "#009999"; $stick3 = "#00AAAA"; $stick4 = "#00BBBB"; $stick5 = "#00CCCC"; break;
	}
?>
<style>
	/************************
	*                       *
	*    File: text.php     *
	*                       *
	************************/
	@charset "UTF-8";
	
	/* Thème: "<?php echo($_SESSION['theme']); ?>" */
	
	::-webkit-scrollbar { background-color: <?php echo("$bgcolor"); ?>; }
	::-webkit-scrollbar:horizontal { background-color: <?php echo("$bgcolor"); ?>; }
	::-webkit-scrollbar-track-piece { background-color: <?php echo("$bgcolor"); ?>; border: 1px solid <?php echo("$border"); ?>; }
	::-webkit-scrollbar-thumb { border: 1px solid <?php echo("$thumb"); ?>; -webkit-box-shadow: inset 0 0 0 .0625em rgb(180,180,180), inset 0 0 0 .375em <?php echo("$rgb"); ?>; }
	::-webkit-scrollbar-thumb:hover { -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb_r"); ?>, inset 0 0 0 .375em <?php echo("$rgb_r"); ?>; }
	::-webkit-scrollbar-corner { background-color: <?php echo("$bgcolor"); ?>; }
	::-webkit-scrollbar-button { background-color: <?php echo("$bgcolor"); ?>; border: 1px solid <?php echo("$border"); ?>; }
	::-webkit-scrollbar-button:hover { -webkit-box-shadow: inset 0 0 0 .0625em <?php echo("$rgb_r"); ?>, inset 0 0 0 .375em <?php echo("$rgb_r"); ?>; }
	userswitch-label { border: 2px solid <?php echo("$border"); ?>; border-radius: 50px; }
	.userswitch-inner:before, .userswitch-inner:after { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
	.userswitch-switch { background-color: <?php echo("$bgcolor"); ?>; border: 2px solid <?php echo("$border"); ?>; border-radius: 50px; }
	html, input { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
	input:hover { background-color: <?php echo("$color"); ?>; color: <?php echo("$bgcolor"); ?>; }
	.list:hover { background-color: <?php echo("$bglist"); ?>; color: <?php echo("$color"); ?>; }
	.modif, .modif:hover { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
	.controls:hover { background-color: <?php echo("$bglist"); ?>; color: <?php echo("$color"); ?>; }
	.ACT, #msg3 { color: <?php echo("$actcolor"); ?>; }
	.WARN:hover, .WARN:hover { color: <?php echo("$bgcolor"); ?>; }
	.ACT:hover { background-color: <?php echo("$actcolor"); ?>; }
	select { background-color: <?php echo("$bgcolor"); ?>; color: <?php echo("$color"); ?>; }
	select:hover { background-color: <?php echo("$bglist"); ?>; }
	fieldset { background-color: <?php echo("$bgcolor"); ?>; }
	.about, #popup, #popupabout, #progressbarControl { background-color: <?php echo("$bgcolor"); ?>; }
	#progressbar { background-color: <?php echo("$bglist"); ?>; }
	h2 { background-color: <?php echo("$color"); ?>; color: <?php echo("$bgcolor"); ?>; }
	a { color: <?php echo("$color"); ?>; }
	.profile:hover { background-color: <?php echo("$bglist"); ?>; }
	.volume { background-color: <?php echo("$bgcolor"); ?>; }
	.volume:hover { background-color: <?php echo("$bglist"); ?>; }
	.stick1 { border: 1px solid <?php echo("$stick1"); ?>; }
	.stick2 { border: 1px solid <?php echo("$stick2"); ?>; }
	.stick3 { border: 1px solid <?php echo("$stick3"); ?>; }
	.stick4 { border: 1px solid <?php echo("$stick4"); ?>; }
	.stick5 { border: 1px solid <?php echo("$stick5"); ?>; }
	
	/********
	*  END  *
	********/
</style>
<!-- END -->
