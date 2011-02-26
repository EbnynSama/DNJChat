<?php
$textPart = str_word_count ( $text, 1 );
$textPart [0] = "/$textPart[0]";
if ($textPart [0] == "/clear" and $textPart [1] == "last") {
	$noText = "yes";
	$query = "SELECT * FROM $dbtable[online] WHERE id = '$userID'";
	$result = mysql_query ( $query );
	$num = mysql_num_rows ( $result );
	while ( $d = mysql_fetch_assoc ( $result ) ) {
		$query2 = "SELECT * FROM $dbtable[new_log] WHERE user = '<strong>$d[user]</strong>' ORDER BY id DESC LIMIT 1";
		$result2 = mysql_query ( $query2 );
		$num2 = mysql_num_rows ( $result2 );
		while ( $d2 = mysql_fetch_assoc ( $result2 ) ) {
			mysql_query ( "DELETE FROM $dbtable[new_log] WHERE id = '$d2[id]'" );
		
		}
	}
}
if ($textPart [0] == "/quit") {
	mysql_query ( "DELETE FROM $dbtable[online] WHERE id = '$userID'" );
	header ( 'Location: logout.php' );
	$query = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
	$result = mysql_query ( $query );
	$num = mysql_num_rows ( $result );
	while ( $d = mysql_fetch_assoc ( $result ) ) {
		if ($d ['mutet'] == "yes") {
		} else {
			$postusername = "<i>" . $ChatBot . "</i>";
			$text = "[b][i]" . $messageLogout . "[/i][/b]";
		}
	}
}
if ($textPart [0] == "/logout") {
	mysql_query ( "DELETE FROM $dbtable[online] WHERE id = '$userID'" );
	mysql_query ( $query );
	header ( 'Location: logout.php' );
	$query = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
	$result = mysql_query ( $query );
	$num = mysql_num_rows ( $result );
	while ( $d = mysql_fetch_assoc ( $result ) ) {
		if ($d ['mutet'] == "yes") {
		} else {
			$postusername = "<i>" . $ChatBot . "</i>";
			$text = "[b][i]" . $messageLogout . "[/i][/b]";
		}
	}
}
if ($textPart [0] == "/pw") {
	$new_pw = str_replace ( "/pw", "", $text );
	$query = sprintf ( "UPDATE $dbtable[users] SET password = '%s' WHERE id = $userID AND username = '%s'", mysql_real_escape_string ( md5 ( $new_pw ) ), mysql_real_escape_string ( $_SESSION ['username'] ) );
	mysql_query ( $query );
	$postusername = "<i>" . $ChatBot . "</i>";
	$text = "[b][i]" . $messagePassword . "[/i][/b]";
}
if ($textPart [0] == "/kreisch") {
	$postusername = "<i>" . $ChatBot . "</i>";
	$text = "[b][i]" . "$username\: $textPart[1], " . $messageNoIgnore . "[/i][/b]";
}
if ($textPart [0] == "/nick") {
	$textPart [2] = substr ( $textPart [1], 0, 20 );
	if (preg_match ( "/$username/", $textPart [1] )) {
		mysql_query ( "UPDATE $dbtable[online] SET user = '$username' WHERE id= '$userID'" );
		$postusername = "<i>" . $ChatBot . "</i>";
		$text = "[b][i]" . $messageNickChange . " " . $textPart [1] . "[/i][/b]";
	} else {
		mysql_query ( "UPDATE $dbtable[online] SET user = '($textPart[1])' WHERE id= '$userID'" );
		$postusername = "<i>" . $ChatBot . "</i>";
		$text = "[b][i]" . $messageNickChange . " " . $textPart [1] . "[/i][/b]";
	}
}
$query = "SELECT * FROM $dbtable[users] WHERE username = '$username'";
$result = mysql_query ( $query );
while ( $d = mysql_fetch_assoc ( $result ) ) {
	if ($d ['role'] == "admin" or $d ['role'] == "mod") {
		if ($textPart [0] == "/clear" and $textPart [1] == "log") {
			$query3 = "DELETE FROM $dbtable[old_log]";
			mysql_query ( $query3 );
			$query2 = "DELETE FROM $dbtable[new_log]";
			mysql_query ( $query2 );
			$postusername = "<i>" . $ChatBot . "</i>";
			$text = "[b][i]" . $messageClearLog . "[/i][/b]";
		}
		if ($textPart [0] == "/kick") {
			$querykick = "SELECT * FROM $dbtable[users] WHERE username = '$textPart[1]'";
			$resultkick = mysql_query ( $querykick );
			while ( $kick = mysql_fetch_assoc ( $resultkick ) ) {
				if ($kick ['role'] == "admin" or $kick ['role'] == "mod") {
					$noText = "yes";
				} else {
					$query = "SELECT * FROM $dbtable[online] WHERE user = '$textPart[1]'";
					$result = mysql_query ( $query );
					while ( $k = mysql_fetch_assoc ( $result ) ) {
						mysql_query ( "DELETE FROM $dbtable[online] WHERE id = '$k[id]'" );
						mysql_query ( "UPDATE $dbtable[users] SET mutet = 'yes' WHERE username = '$textPart[1]'" );
						$postusername = "<i>" . $ChatBot . "</i>";
						$text = "[b][i]" . "$textPart[1] " . $messageKick . "[/i][/b]";
					}
				}
			}
		}
	}
}
?>