
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
