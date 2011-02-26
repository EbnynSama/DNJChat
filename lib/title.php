<?php
require 'check.php';
require '../lang/' . $lang . '.php';
$query3 = "SELECT * FROM $dbtable[new_log] ORDER BY id DESC LIMIT 1";
$result3 = mysql_query ( $query3 );
while ( $t = mysql_fetch_assoc ( $result3 ) ) {
	$date = $t ['time'] + (5 * 1);
	$time = time ();
	if ($time <= $date) {
		$old = array ("<strong>", "</strong>", "<i>", "</i>", "<b>", "</b>" );
		$new = str_replace ( $old, "", $t ['user'] );
		$input = array ("[@ ]", "[ @]", "[@ ]", "[ @]", "[@ ]", "[ @]", "[@ ]", "[ @]", "[@ ]", "[ @]" );
		$signal = array_rand ( $input );
		echo "$input[$signal] $new @ " . $pageTitle;
	} elseif ($t ['user'] == $d ['user']) {
		echo "Chat @ " . $pageTitle;
	} else {
		echo "Chat @ " . $pageTitle;
	}
}
?>