<?php
switch ($textPart [0]) {
	case '/bsy' :
		$query = "SELECT * FROM $dbtable[online]";
		$result = mysql_query ( $query );
		while ( $d = mysql_fetch_assoc ( $result ) ) {
			if (preg_match ( "/$username/", $d ['user'] )) {
				if (preg_match ( "/BSY/", $d ['user'] )) {
				} else {
					mysql_query ( "UPDATE $dbtable[online] SET user = '[BSY]_$username' WHERE id= '$userID'" );
					$postusername = '<i>' . $ChatBot . '</i>';
					$text = "[b][i]" . $messageBSY . "[/i][/b]";
				}
			}
		}
		break;
	
	case '/afk' :
		$query = "SELECT * FROM $dbtable[online]";
		$result = mysql_query ( $query );
		while ( $d = mysql_fetch_assoc ( $result ) ) {
			if (preg_match ( "/$username/", $d ['user'] )) {
				if (preg_match ( "/AFK/", $d ['user'] )) {
				} else {
					mysql_query ( "UPDATE $dbtable[online] SET user = '[AFK]_$username' WHERE id= '$userID'" );
					$postusername = '<i>' . $ChatBot . '</i>';
					$text = "[b][i]" . $messageAFK . "[/i][/b]";
				}
			}
		}
		break;
	
	case '/back' :
		$query = "SELECT * FROM $dbtable[online]";
		$result = mysql_query ( $query );
		while ( $d = mysql_fetch_assoc ( $result ) ) {
			if (preg_match ( "/$username/", $d ['user'] )) {
				if (preg_match ( "/BSY/", $d ['user'] ) or preg_match ( "/AFK/", $d ['user'] )) {
					mysql_query ( "UPDATE $dbtable[online] SET user = '$username' WHERE id= '$userID'" );
					$postusername = '<i>' . $ChatBot . '</i>';
					$text = "[b][i]" . $messageBACK . "[/i][/b]";
				}
			}
		}
		break;
}

?>