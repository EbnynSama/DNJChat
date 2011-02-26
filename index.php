<?php
require 'check.php';
require 'lang/' . $lang . '.php';
$currentDate = gmdate ( "D, d M Y H:i:s" ) . "GMT";
header ( "Expires: $currentDate" );
header ( "Last-Modified: $currentDate" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( 'Content-Type: text/html; charset=UTF-8' );
$conn = mysql_connect ( $dbhost, $dbuser, $dbpass ) or die ( 'Error connecting to mysql' );
mysql_select_db ( $dbname );
$date = date ( 'H:i:s' );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<title><?php
echo $pageTitle;
?> - Chat</title>
<style type="text/css">
@charset "utf-8";

body {
	margin: 0;
	padding: 0;
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 13px;
}

input.submit {
	background-color: #ffffff;
	border: 1px solid #000000;
	width: 100%;
}

input {
	background-color: #ffffff;
	border: 1px solid #000000;
	width: 200px;
	outline: none;
}

input:hover {
	backgound-color: #E6E6E6;
	border: 1px solid #8A084B;
}

input:focus {
	backgound-color: #A4A4A4;
	border: 1px solid #2A0A0A;
}

a.bbcodeborder {
	padding-bottom: 7px;
}

iframe#chat {
	width: 748px;
	height: 300px;
	border: 1px solid #000000;
}

table {
	-webkit-border-top-left-radius: 5px;
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-moz-border-radius-topleft: 8px;
	-moz-border-radius-topright: 8px;
	-moz-border-radius-bottomleft: 8px;
	-moz-border-radius-bottomright: 8px;
	border-top-left-radius: 5px 5px;
	border-top-right-radius: 5px 5px;
	border-bottom-right-radius: 5px 5px;
	border-bottom-left-radius: 5px 5px;
}

div#loginbox {
	-webkit-border-top-left-radius: 5px;
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-moz-border-radius-topleft: 8px;
	-moz-border-radius-topright: 8px;
	-moz-border-radius-bottomleft: 8px;
	-moz-border-radius-bottomright: 8px;
	border-top-left-radius: 5px 5px;
	border-top-right-radius: 5px 5px;
	border-bottom-right-radius: 5px 5px;
	border-bottom-left-radius: 5px 5px;
}

div#LoadBar {
	-webkit-border-top-left-radius: 5px;
	-webkit-border-top-right-radius: 5px;
	-webkit-border-bottom-right-radius: 5px;
	-webkit-border-bottom-left-radius: 5px;
	-moz-border-radius-topleft: 8px;
	-moz-border-radius-topright: 8px;
	-moz-border-radius-bottomleft: 8px;
	-moz-border-radius-bottomright: 8px;
	border-top-left-radius: 5px 5px;
	border-top-right-radius: 5px 5px;
	border-bottom-right-radius: 5px 5px;
	border-bottom-left-radius: 5px 5px;
}
</style>
<!--[if IE]>
    <style type="text/css">
	a.bbcodeborder {
	padding-bottom: 6px;
	}
	</style>
  <![endif]-->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/request_title.js"></script>
<script type="text/javascript">
function insert(aTag, eTag) {
  var input = frames['text'].document.forms['message'].elements['text'];
  input.focus();
  if(typeof document.selection != 'undefined') {
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = aTag + insText + eTag;
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -eTag.length);
    } else {
      range.moveStart('character', aTag.length + insText.length + eTag.length);      
    }
    range.select();
  }
  else if(typeof input.selectionStart != 'undefined')
  {
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);    var pos;
    if (insText.length == 0) {
      pos = start + aTag.length;
    } else {
      pos = start + aTag.length + insText.length + eTag.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  else
  {
    var pos;
    var re = new RegExp('^[0-9]{0,3}$');
    while(!re.test(pos)) {
      pos = prompt("Einsetzen an Position (0.." + input.value.length + "):", "0");
    }
    if(pos > input.value.length) {
      pos = input.value.length;
    }
    var insText = prompt("Bitte geben Sie den zu formatierenden Text ein:");
    input.value = input.value.substr(0, pos) + aTag + insText + eTag + input.value.substr(pos);
  }
}
</script>
<script type="text/javascript">
var zaehler = 1;
function load3(ziel) {
 if ( zaehler < ziel) {
  zaehler = zaehler + 1;
  document.getElementById("status3").style.width = zaehler + "px";
 var prozent = Math.round( zaehler/ziel * 100);
  document.getElementById("counter3").innerHTML = prozent+" %";
  window.setTimeout("load3('" + ziel + "')", 10);
 }
 else {
  zaehler = 1;
	document.getElementById("LoadBar").style.display = "none";
	document.getElementById("copyright").style.display = "none";
	document.getElementById("content").style.display = "block";
	setFocus();
 }
}
 function setFocus() {
 frames['text'].document.message.text.focus();
	}
function scrollNo() {
frames['chat'].scrollChat();
}
</script>
<?php
if ($_GET ['action'] == "Logout") {
	session_unset ();
	session_destroy ();
	echo "<script type=\"text/javascript\">
setTimeout(\"parent.location.href='./'\",0);
</script>";
}
if ($_GET ['action'] == "logout") {
	mysql_query ( "DELETE FROM $dbtable[online] WHERE id = '$userID'" );
	mysql_query ( $query );
	$query = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
	$result = mysql_query ( $query );
	$num = mysql_num_rows ( $result );
	while ( $d = mysql_fetch_assoc ( $result ) ) {
		if ($d ['mutet'] == "yes") {
		} else {
			$bottext = "$username hat den Chat verlassen.";
			mysql_query ( "INSERT INTO $dbtable[new_log] (user, date, text)
VALUES ('<strong><i>ChatBot</i></strong>', '$date', '<strong><i>$bottext</i></strong>')" );
		}
	}
	session_unset ();
	session_destroy ();
	echo "<script type=\"text/javascript\">
setTimeout(\"parent.location.href='./'\",0);
</script>";
} else {
	if ($_POST ['reg']) {
		$count = mb_strlen ( $_POST ['username'] );
		if (empty ( $_POST ['username'] ) or empty ( $_POST ['password'] )) {
			echo "<b><i>Es m&uuml;ssen beide Felder ausgef&uuml;llt werden.</i></b>";
		} elseif ($count > 20) {
			echo "<b><i>Der Benutzername darf nur maximal 20 Zeichen enthalten.</i></b>";
		} else {
			$query = sprintf ( "SELECT COUNT(id) FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s')", mysql_real_escape_string ( htmlspecialchars ( $_POST ['username'] ) ) );
			$result = mysql_query ( $query );
			list ( $count ) = mysql_fetch_row ( $result );
			if ($count >= 1) {
				echo "<b><i>Der gew&auml;hlte Benutzername ist bereits vergeben, $_POST[username].</i></b>";
			} else {
				$query = ("SELECT * FROM $dbtable[users]");
				$result = mysql_query ( $query );
				list ( $count ) = mysql_fetch_row ( $result );
				if ($count < 1) {
					$query = sprintf ( "INSERT INTO $dbtable[users](username,password,role) VALUES ('%s','%s','admin');", mysql_real_escape_string ( htmlspecialchars ( $_POST ['username'] ) ), mysql_real_escape_string ( htmlspecialchars ( md5 ( $_POST ['password'] ) ) ) );
					mysql_query ( $query );
				} else {
					$query = sprintf ( "INSERT INTO $dbtable[users](username,password) VALUES ('%s','%s');", mysql_real_escape_string ( htmlspecialchars ( $_POST ['username'] ) ), mysql_real_escape_string ( htmlspecialchars ( md5 ( $_POST ['password'] ) ) ) );
					mysql_query ( $query );
				}
				session_start ();
				$query = sprintf ( "SELECT COUNT(id) FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s') AND password='%s'", mysql_real_escape_string ( $_POST ['username'] ), mysql_real_escape_string ( md5 ( $_POST ['password'] ) ) );
				$result = mysql_query ( $query );
				list ( $count ) = mysql_fetch_row ( $result );
				if ($count == 1) {
					$_SESSION ['authenticated'] = true;
					$_SESSION ['username'] = $_POST ['username'];
					$query = sprintf ( "UPDATE $dbtable[users] SET lastaction = '%s' WHERE UPPER(username) = UPPER('%s') AND password = '%s'", mysql_real_escape_string ( $date ), mysql_real_escape_string ( $_POST ['username'] ), mysql_real_escape_string ( md5 ( $_POST ['password'] ) ) );
					mysql_query ( $query );
					$username = $_SESSION ['username'];
					$datei = time ();
					$query = sprintf ( "SELECT id FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s')", mysql_real_escape_string ( $_SESSION ['username'] ) );
					$result = mysql_query ( $query );
					list ( $userID ) = mysql_fetch_row ( $result );
					$query = "SELECT COUNT('id') FROM $dbtable[online] WHERE id = '$userID'";
					$result = mysql_query ( $query );
					list ( $count ) = mysql_fetch_row ( $result );
					if ($count < 1) {
						
						$query = sprintf ( "INSERT INTO $dbtable[online](user,date,id) VALUES ('%s','%s','%s')", mysql_real_escape_string ( htmlspecialchars ( $_SESSION ['username'] ) ), mysql_real_escape_string ( htmlspecialchars ( $datei ) ), mysql_real_escape_string ( htmlspecialchars ( $userID ) ) );
						mysql_query ( $query );
						mysql_query ( "UPDATE $dbtable[users] SET mutet = 'no' WHERE username = '$_SESSION[username]'" );
						$bottext = "$username betritt den Chat.";
						mysql_query ( "INSERT INTO $dbtable[new_log] (user, date, text)
VALUES ('<strong><i>ChatBot</i></strong>', '$date', '<strong><i>$bottext</i></strong>')" );
					}
				}
			}
		}
	} elseif ($_POST) {
		session_start ();
		$query = sprintf ( "SELECT COUNT(id) FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s') AND password='%s'", mysql_real_escape_string ( $_POST ['username'] ), mysql_real_escape_string ( md5 ( $_POST ['password'] ) ) );
		$result = mysql_query ( $query );
		list ( $count ) = mysql_fetch_row ( $result );
		if ($count == 1) {
			$_SESSION ['authenticated'] = true;
			$_SESSION ['username'] = $_POST ['username'];
			$query = sprintf ( "UPDATE $dbtable[users] SET lastaction = '%s' WHERE UPPER(username) = UPPER('%s') AND password = '%s'", mysql_real_escape_string ( $date ), mysql_real_escape_string ( $_POST ['username'] ), mysql_real_escape_string ( md5 ( $_POST ['password'] ) ) );
			mysql_query ( $query );
			$username = $_SESSION ['username'];
			$datei = time ();
			$query = sprintf ( "SELECT id FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s')", mysql_real_escape_string ( $_SESSION ['username'] ) );
			$result = mysql_query ( $query );
			list ( $userID ) = mysql_fetch_row ( $result );
			$query = "SELECT COUNT('id') FROM $dbtable[online] WHERE id = '$userID'";
			$result = mysql_query ( $query );
			list ( $count ) = mysql_fetch_row ( $result );
			if ($count < 1) {
				$query = sprintf ( "SELECT id FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s')", mysql_real_escape_string ( $_SESSION ['username'] ) );
				$result = mysql_query ( $query );
				list ( $userID ) = mysql_fetch_row ( $result );
				$query = sprintf ( "INSERT INTO $dbtable[online](user,date,id) VALUES ('%s','%s','%s')", mysql_real_escape_string ( htmlspecialchars ( $_SESSION ['username'] ) ), mysql_real_escape_string ( htmlspecialchars ( $datei ) ), mysql_real_escape_string ( htmlspecialchars ( $userID ) ) );
				mysql_query ( $query );
				mysql_query ( "UPDATE $dbtable[users] SET mutet = 'no' WHERE username = '$_SESSION[username]'" );
				$bottext = "$username betritt den Chat.";
				mysql_query ( "INSERT INTO $dbtable[new_log] (user, date, text)
VALUES ('<strong><i>ChatBot</i></strong>', '$date', '<strong><i>$bottext</i></strong>')" );
			}
		}
	}
	if ($_SESSION ['authenticated'] == true) {
		?>
</head>
<body style="background-color: #e4e4e4;"
	onload="javascript:load3('400'); messageRequest('lib/title'); setFocus();">
<div id="LoadBar"
	style="position: absolute; left: 50%; top: 30%; margin-left: -213px; height: 26px; padding: 25px; background-color: #e4e4e4; border: solid 1px #000000; display: block; width: 426px;">
<div
	style="margin-left: auto; margin-right: auto; position: relative; width: 400px; background-color: #C0C0C0; border: solid 1px #000000;">
<span
	style="position: absolute; width: 100%; z-index: 3; text-align: center; font-weight: bold;">Chat
wird geladen:&nbsp;<span id="counter3">0%</span></span>
<div id="status3"
	style="position: relative; background-image: url('preloader/bar.png'); background-color: red; width: 0px; height: 22px; border-right: solid 1px #000000; z-index: 2;">&thinsp;</div>
</div>
<div id="copyright"
	style="margin-top: -5px; display: block; text-align: center;">
<p><a href="http://deathnet.de/" target="_blank"
	style="color: #000000; font-weight: small; font-size: 12px; text-decoration: none;">&copy;
DeathNet.de</a></p>
</div>
</div>
<div id="content" style="display: none;">
<table cellspacing="0" cellpadding="0" style="width: 100%; height: 99%;">
	<tr>
		<td>
		<table
			style="background-color: #D8D8D8; margin-left: auto; margin-right: auto; padding: 5px; width: 950px; height: 400px; border: 1px solid #000000;"
			cellspacing="5" cellpadding="0" border="0">
			<tr>
				<td
					style="width: 750px; height: 300px; border: none; text-align: left;"><iframe
					src="lib/chat.php" id="chat" name="chat"
					onclick="javascript:scrollNo();" scrolling="yes" border="0"
					frameborder="0"></iframe></td>
				<td
					style="width: 200px; height: 300px; border: none; text-align: left;"><iframe
					src="lib/onlinelist.php" scrolling="yes" frameborder="0"
					style="height: 300px; width: 200px; border: 1px solid #000000;"
					border="0"></iframe></td>
			</tr>
			<tr>
				<td colspan="2" style="width: 100%;">
				<div
					style="padding: 5px; background-color: #ffffff; border: 1px solid #000000;">
				<a onclick="javascript:insert(':)', '')"><img src="img/smile.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':D', '')"><img src="img/grin.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':(', '')"><img src="img/sad.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':S', '')"><img src="img/confused.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':P', '')"><img src="img/angel.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(';P', '')"><img src="img/razz.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('8)', '')"><img src="img/cool.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('8D', '')"><img src="img/glasses.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':O', '')"><img src="img/surprise.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(';)', '')"><img src="img/wink.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('$)', '')"><img src="img/smile-big.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('=O', '')"><img src="img/eek.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':*', '')"><img src="img/kiss.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert(':|', '')"><img src="img/plain.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('&lt;3', '')"><img
					src="img/favorite.png" border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('?)', '')"><img src="img/help.png"
					border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('!)', '')"><img src="img/warning.png"
					border="0" align="top" alt=""></a> <a class="bbcodeborder"
					style="border-left: 1px solid #000000; padding-left: 5px; padding-top: 5px; padding-right: 0;"
					title="[url] (Hyperlink)"
					onclick="javascript:insert('[url=', '](LINK)[/url]')"><img
					src="img/url.png" border="0" align="top" alt=""></a> <a
					onclick="javascript:insert('[color=]', '[/color]')"
					title="[color=] (z.B. red, blue oder green)"><img
					src="img/color.png" border="0" align="top" alt=""></a> <a
					class="bbcodeborder"
					style="border-right: 1px solid #000000; padding-right: 5px; padding-top: 5px; padding-left: 0;"
					title="[img] (Grafikadresse zwischen [img]-tags setzen."
					onclick="javascript:insert('[img]', '[/img]')"><img
					src="img/img.png" border="0" align="top" alt=""></a> <a
					onclick="javascript:scrollNo()" title="Autoscroll an/ausschalten"><img
					id="scroll" style="display: inline;" src="img/scroll.png"
					border="0" align="top" alt=""><img id="stop" style="display: none;"
					src="img/stop.png" border="0" align="top" alt=""></a> <script
					type="text/javascript">
document.write('<span id="wrap" style="font-size: 12px;"></span>');
</script></div>
				</td>
			</tr>
			<tr>
				<td border="0" style="width: 750px; height: 48px; border: none;"
					valign="top"><iframe name="text" valign="top" scrolling="no"
					src="lib/send.php"
					style="border: 1px solid #000000; padding: 0; margin: 0; width: 100%; height: 46px"
					border="0" frameborder="0"></iframe></td>
				<td style="height: 48px;" valign="top"><input type="button"
					style="background-image: url('img/logout.png'); background-position: 10px 10px; background-repeat: no-repeat; height: 48px; width: 202px;"
					name="Logout" type="submit" value="Ausloggen"
					onclick="javascript:parent.location.href='./?action=logout'"></td>
			</tr>
		</table>
		</td>
	</tr>
	<table>
		<div></div>
		<?php
	}
}
if ($_SESSION ['authenticated'] == false) {
	echo "</head><body style=\"background-color: #e4e4e4;\" onload=\"self.focus();document.login.username.focus()\">";
	?>
		<div id="loginbox" align="center"
			style="position: absolute; left: 50%; top: 30%; margin-left: -213px; height: 100px; padding: 25px; background-color: #e4e4e4; border: solid 1px #000000; display: block; width: 426px;">
		<table>
			<form action="./" name="login" method="post">
			<tr>
				<td>Benutzername:</td>
				<td><input type="text" name="username" id="username"
					class="username"></td>
			</tr>
			<tr>
				<td>Passwort:</td>
				<td><input type="password" name="password" id="password"
					class="password"></td>
			</tr>
			<tr>
				<td><input type="submit" class="submit" value="Login"></td>
				<td><input type="submit" class="submit" name="reg"
					value="Registrieren"></td>
			</tr>
			</form>
		</table>
		<div id="copyright"
			style="margin-top: -5px; display: block; text-align: center;">
		<p><a href="http://deathnet.de/" target="_blank"
			style="color: #000000; font-weight: small; font-size: 12px; text-decoration: none;">&copy;
		DeathNet.de - DNJChat 1.0.2 (only for development)</a></p>
		</div>
		</div>
		<?php
}
?>




	</table>
</table>
</div>
</body>
</html>