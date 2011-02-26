<?php
require 'check.php';
require '../lang/' . $lang . '.php';
$conn = mysql_connect ( $dbhost, $dbuser, $dbpass ) or die ( 'Error connecting to mysql' );
mysql_select_db ( $dbname );
function makeURL($link) {
	
	$link = str_replace ( "http://www.", "www.", $link );
	$link = str_replace ( "www.", "http://www.", $link );
	$link = preg_replace ( "/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i", "<a class=\"convertedlink\" target=\"_blank\" title=\"(externe URL)\" href=\"$1\">$1</a>", $link );
	$link = preg_replace ( "/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.
([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i", "<a class=\"convertedlink\" target=\"_blank\" title=\"(externe URL)\" href=\"mailto:$1\">$1</a>", $link );
	
	return $link;
}
$query = "SELECT * FROM $dbtable[new_log] ORDER BY id ASC";
$result = mysql_query ( $query );
$rows = mysql_num_rows ( $result );
$query2 = "SELECT * FROM $dbtable[new_log] ORDER BY id ASC LIMIT 0,50";
$result2 = mysql_query ( $query2 );
$rows2 = mysql_num_rows ( $result2 );
$date = date ( 'H:i:s' );
$bottext = $messageClear;
if ($rows > 100) {
	while ( $m = mysql_fetch_assoc ( $result ) ) {
		while ( $m2 = mysql_fetch_assoc ( $result2 ) ) {
			mysql_query ( "DELETE FROM $dbtable[new_log] WHERE id = $m2[id]" );
			mysql_query ( "INSERT INTO $dbtable[old_log] (user, date, text)
			VALUES ('$m2[user]', '$m2[date]', '$m2[text]')" );
		}
	}
	mysql_query ( "INSERT INTO $dbtable[new_log] (user, date, text)
			VALUES ('<strong><i>'.$ChatBot.'</i></strong>', '$date', '<strong><i>$bottext</i></strong>')" );
}
$query = "SELECT * FROM $dbtable[new_log] ORDER BY id ASC";
$result = mysql_query ( $query );
$num = mysql_num_rows ( $result );
$col1 = "first";
$col2 = "second";
$queryban = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
$resultban = mysql_query ( $queryban );
while ( $ban = mysql_fetch_assoc ( $resultban ) ) {
	if ($ban ['mutet'] == "yes") {
		$date = "<img src=\"../img/mod.png\" class=\"role\" align=\"top\" />&nbsp;($date)";
		echo '<div onclick="javascript:scrolling = false" style="padding-left: 5px;" class="first"><p><span id="date" onclick="javascript:scrolling = false">' . $date . '&nbsp;</span><span id="user" onclick="javascript:scrolling = false"><i>' . $ChatBot . '</i></span><span onclick="javascript:scrolling = false">:&nbsp;<i>' . $messageSessionTimeout . '</i></span></p></div>';
	} else {
		while ( $m = mysql_fetch_assoc ( $result ) ) {
			$m ['text'] = wordwrap ( $m ['text'], 80, " # ", true );
			$m ['text'] = str_replace ( "&amp;", "&", $m ['text'] );
			$m ['text'] = str_replace ( " # ", "<br />", $m ['text'] );
			$m ['text'] = preg_replace ( '/\[b\](.*?)\[\/b\]/', '<b>$1</b>', $m ['text'] );
			$m ['text'] = preg_replace ( '/\[i\](.*?)\[\/i\]/', '<i>$1</i>', $m ['text'] );
			$m ['text'] = preg_replace ( '/\[code\](.*?)\[\/code\]/', '<code>$1</code>', $m ['text'] );
			$m ['text'] = preg_replace ( '/\[color=([^ ]+).*\](.*?)\[\/color\]/', '<font color="#$1">$2</font>', $m ['text'] );
			if (strpos ( $m ['text'], "[/url]" ) > 0 or strpos ( $m ['text'], "[/img]" ) > 0) {
				$m ['text'] = preg_replace ( '/\[url=([^ ]+).*\](.*)\[\/url\]/', '<a class="convertedlink" target="_blank" title="(externe URL)" href="$1">$2*</a>', $m ['text'] );
				$m ['text'] = preg_replace ( '/\[img\](.*?)\[\/img\]/', '<a href="$1" target="_blank" style="border: none; text-decoration: none;" align="top"><img src="$1" class="includedIMG" border="0" title="(engef&uuml;gte Grafik)" /></a>', $m ['text'] );
			} else {
				$m ['text'] = makeURL ( $m ['text'] );
			}
			$m ['text'] = str_replace ( ":)", "<img src=\"../img/smile.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":(", "<img src=\"../img/sad.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":S", "<img src=\"../img/confused.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":P", "<img src=\"../img/angel.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ";P", "<img src=\"../img/razz.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "8)", "<img src=\"../img/cool.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":O", "<img src=\"../img/surprise.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":D", "<img src=\"../img/grin.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":*", "<img src=\"../img/kiss.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ":|", "<img src=\"../img/plain.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "&lt;3", "<img src=\"../img/favorite.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( ";)", "<img src=\"../img/wink.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "$)", "<img src=\"../img/smile-big.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "=O", "<img src=\"../img/eek.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "?)", "<img src=\"../img/help.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "!)", "<img src=\"../img/warning.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = str_replace ( "8D", "<img src=\"../img/glasses.png\" align=\"top\" />", $m ['text'] );
			$m ['text'] = nl2br ( $m ['text'] );
			if ($m ['role'] == "admin") {
				$m ['date'] = "<img src=\"../img/admin.png\" class=\"role\" align=\"top\" />&nbsp;($m[date])";
			} elseif ($m ['role'] == "mod") {
				$m ['date'] = "<img src=\"../img/mod.png\" class=\"role\" align=\"top\" />&nbsp;($m[date])";
			} elseif ($m ['role'] == "vip") {
				$m ['date'] = "<img src=\"../img/vip.png\" class=\"role\" align=\"top\" />&nbsp;($m[date])";
			} elseif (empty ( $m ['role'] )) {
				$m ['date'] = "<img src=\"../img/user.png\" class=\"role\" align=\"top\" />&nbsp;($m[date])";
			}
			for($num = 0; $num < 1; $num ++) {
				$color = ($color == $col1) ? $col2 : $col1;
				?>
<div onclick="javascript:scrolling = false" style="padding-left: 5px;"
	class="<?php
				echo $color;
				?>">
<p><span id="date" onclick="javascript:scrolling = false"><?php
				echo $m ['date'];
				?>&nbsp;</span><span id="user"
	onclick="javascript:scrolling = false"><?php
				echo $m ['user'];
				?></span><span onclick="javascript:scrolling = false">:&nbsp;<?php
				echo $m ['text'];
				?></span></p>
</div>
<?php
			}
		}
	}
}
mysql_close ( $conn );
?>