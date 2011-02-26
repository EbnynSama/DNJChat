<?php
require 'check.php';
require '../lang/' . $lang . '.php';
$currentDate = gmdate ( "D, d M Y H:i:s" ) . "GMT";
header ( "Expires: $currentDate" );
header ( "Last-Modified: $currentDate" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
?>
<html>
<head>
</head>
<body>
<table style="width: 100%;" cellspacing="0" cellpadding="0">
	<tr>
		<td style="width: 100%;">
		<div class="onlineuser"
			style="display: block; padding-top: 4px; padding-bottom: 4px; font-size: 13px;"
			align="center"><strong>Benutzer online:</strong></div>
		</td>
	</tr>
<?php
$query = "SELECT * FROM $dbtable[online] ORDER BY user ASC";
$result = mysql_query ( $query );
$num = mysql_num_rows ( $result );
$i = 1;
$datei = time ();
$date = date ( 'H:i:s' );
while ( $d = mysql_fetch_assoc ( $result ) ) {
	$dtime = $d ['date'] + (60 * 60);
	if ($datei > $dtime) {
		mysql_query ( "DELETE FROM $dbtable[online] WHERE date = $d[date]" );
		mysql_query ( "UPDATE $dbtable[users] SET mutet = 'yes' WHERE id = '$d[id]'" );
		$bottext = "$d[user] wurde ausgeloggt (Timeout).";
		mysql_query ( "INSERT INTO $dbtable[new_log] (user, date, text)
VALUES ('<strong><i>'.$ChatBot.'</i></strong>', '$date', '<strong><i>$bottext</i></strong>')" );
	}
}
$query = "SELECT * FROM $dbtable[online] ORDER BY user ASC";
$result = mysql_query ( $query );
$num = mysql_num_rows ( $result );
$i = 1;
$col1 = "first";
$col2 = "second";
while ( $user = mysql_fetch_assoc ( $result ) ) {
	for($num = 0; $num < 1; $num ++) {
		$color = ($color == $col1) ? $col2 : $col1;
		$query2 = "SELECT * FROM $dbtable[users] WHERE id = '$user[id]'";
		$result2 = mysql_query ( $query2 );
		$num = mysql_num_rows ( $result2 );
		while ( $m = mysql_fetch_assoc ( $result2 ) ) {
			if ($m ['role'] == "admin") {
				$role = "<img src=\"../img/admin.png\" align=\"top\" title=\"Administrator\" border=\"0\" />";
			} elseif ($m ['role'] == "mod") {
				$role = "<img src=\"../img/mod.png\" align=\"top\" title=\"Moderator\" border=\"0\" />";
			} elseif ($m ['role'] == "vip") {
				$role = "<img src=\"../img/vip.png\" align=\"top\" title=\"VIP - Member\" border=\"0\" />";
			} elseif (empty ( $m ['role'] )) {
				$role = "<img src=\"../img/user.png\" align=\"top\" title=\"Registrierter Benutzer\" border=\"0\" />";
			}
		}
		?>
<tr>
		<td style="width: 100%;">
		<div class="<?php
		echo $color;
		?>">&nbsp;<a
			href="javascript:change('usermenu<?php
		echo $i;
		?>');"
			class="role"><?php
		echo $role;
		?></a><a href="javascript:change('usermenu<?php
		echo $i;
		?>');"><?php
		echo $user ['user'];
		?></a></div>
		<div class="menu-<?php
		echo $color;
		?>"
			id="usermenu<?php
		echo $i;
		?>" style="display: none;">
<?php
		$query2 = "SELECT * FROM $dbtable[users] WHERE username = '$username'";
		$result2 = mysql_query ( $query2 );
		while ( $d2 = mysql_fetch_assoc ( $result2 ) ) {
			if ($d2 ['role'] == "admin" or $d2 ['role'] == "mod") {
				?>
<a
			onclick="javascript:parent.frames['text'].document.getElementById('text').value = '/kick <?php
				echo $user ['user'];
				?>'; parent.frames['text'].document.forms['message'].submit();"><img
			src="../img/kick.png" title="Benutzer kicken" border="0" /></a>
<?php
			}
		}
		?>
<a
			onclick="javascript:setFocus(); parent.frames['text'].document.getElementById('text').value = '/w <?php
		echo $user ['user'];
		?> ';"><img src="../img/w.png" title="Benutzer anfl&uuml;stern"
			border="0" /></a> <a
			onclick="javascript:parent.frames['text'].document.getElementById('text').value = '/kreisch <?php
		echo $user ['user'];
		?>'; parent.frames['text'].document.forms['message'].submit(); setFocus();"><img
			src="../img/s.png" title="Benutzer anschreihen" border="0" /></a></div>
		</td>
	</tr>
<?php
		$i ++;
	}
}
?>
</table>
</body>
</html>