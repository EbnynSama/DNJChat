<?php
include 'config.php';
session_start ();
$conn = mysql_connect ( $dbhost, $dbuser, $dbpass ) or die ( 'Error connecting to mysql' );
mysql_select_db ( $dbname );
$query = sprintf ( "SELECT id FROM $dbtable[users] WHERE UPPER(username) = UPPER('%s')", mysql_real_escape_string ( $_SESSION ['username'] ) );
$result = mysql_query ( $query );
list ( $userID ) = mysql_fetch_row ( $result );
if (! $userID) {
	// not logged in!
	$loggedin = '0';
	$username = 'Gast';
} else {
	$loggedin = '1';
	$username = $_SESSION ['username'];
}
?>