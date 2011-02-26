<?php
require 'check.php';
require '../lang/' . $lang . '.php';
$queryban = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
$resultban = mysql_query ( $queryban );
while ( $ban = mysql_fetch_assoc ( $resultban ) ) {
	if ($ban ['mutet'] == "yes") {
		header ( 'Location: logout.php' );
	}
}
$query = "SELECT * FROM $dbtable[online] WHERE id = '$userID'";
$result = mysql_query ( $query );
$num = mysql_num_rows ( $result );
while ( $d = mysql_fetch_assoc ( $result ) ) {
	$queryban = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
	$resultban = mysql_query ( $queryban );
	while ( $ban = mysql_fetch_assoc ( $resultban ) ) {
		if ($ban ['mutet'] == "yes") {
			session_unset ();
			session_destroy ();
			$done = false;
		} elseif (empty ( $_POST ['text'] )) {
			$done = false;
		} elseif ($_POST) {
			$text = $_POST ['text'];
			$date = date ( 'H:i:s' );
			$postusername = $d ['user'];
			$conn = mysql_connect ( $dbhost, $dbuser, $dbpass ) or die ( 'Error connecting to mysql' );
			mysql_select_db ( $dbname );
			require 'systemC.php';
			require 'customC.php';
			if (empty ( $text )) {
				$done = false;
			} elseif ($noText == "yes") {
				$done = false;
			} else {
				$query2 = "SELECT * FROM $dbtable[users] WHERE username = '$username'";
				$result2 = mysql_query ( $query2 );
				while ( $m2 = mysql_fetch_assoc ( $result2 ) ) {
					$time = time ();
					$textEnd = htmlspecialchars ( urldecode ( $text ) );
					mysql_query ( "UPDATE $dbtable[online] SET date = '$time' WHERE user= '$username'" );
					mysql_query ( "INSERT INTO $dbtable[new_log] (user, date, text, role, time)
VALUES ('<strong>$postusername</strong>', '$date', '$textEnd', '$m2[role]', '$time')" );
				}
			}
		}
	}
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<style type="text/css">
body {
	padding: 0;
	margin: 0;
}
</style>
<script language="JavaScript" type="text/javascript"> 

var hotkey=13;

function enter(e)

{

if (e && e.which==hotkey){
document.forms["message"].submit();
  document.getElementById('text').disabled = true;
  document.getElementById('text').value = 'Nachricht wird gesendet...'; 
}
else if (event.keyCode==hotkey){
document.forms["message"].submit();
  document.getElementById('text').disabled = true;
  document.getElementById('text').value = 'Nachricht wird gesendet...'; 
}

}
</script>
<script type="text/javascript" language="javascript">
   var formular = null;
   var textfeld = null;
   var uebrigFeld = null;
   var intv = null;
   var maxZeichen = 0;

   function Zaehlen ()
   {
       var laenge = textfeld.value.length;
       var uebrig = maxZeichen - laenge;

       if (uebrig < 0)
       {
             var inhalt = textfeld.value;
             var neuerInhalt = inhalt.substr(0, maxZeichen);
             textfeld.value = neuerInhalt;
             uebrig = 0;
       }
    
       uebrigFeld.innerHTML = uebrig + "/1100 Zeichen";
   }
   </script>
<script type="text/javascript">
	function scrollTop() {
	window.scrollTo(0, 0);
	window.setTimeout("scrollTop()", 1);
	}
	</script>
<!--[if IE]>
    <script type="text/javascript">
	function scrollTop() { }
	function scrollBottom() {
	window.scroll(1, 500000);
	window.setTimeout("scrollBottom()", 60);
	}
	scrollBottom();
	</script>
  <![endif]-->
<script type="text/javascript">
	scrollTop();
</script>
</head>
<body style="background-color: #ffffff;"
	onload="self.focus();document.message.text.focus()">
<form method="post" accept-charset="utf-8" name="message"
	autocomplete="off" id="message" action="send.php"><?php
	$queryban = "SELECT * FROM $dbtable[users] WHERE id = '$userID'";
	$resultban = mysql_query ( $queryban );
	while ( $ban = mysql_fetch_assoc ( $resultban ) ) {
		if ($ban ['mutet'] == "yes") {
			?>

<textarea accept-charset="utf-8" disabled="true"
	style="background-image: url('../img/pen.png'); background-position: 698px 7px; background-repeat: no-repeat; resize: none; width: 750px; padding: 15px; padding-left: 30px; padding-right: 30px; height: 46px; border: none;"
	cols="" rows="">Sie wurden entweder von einem Moderator gebannt, oder ihre Session ist beendet.</textarea>

<?php
		} else {
			?> <textarea
	onFocus="formular=this.form; textfeld=this; uebrigFeld=parent.document.getElementById('wrap'); maxZeichen=1100; intv=setInterval('Zaehlen()', 100);"
	onBlur="clearInterval(intv); Zaehlen(); formular=null; textfeld=null; uebrigFeld=null; maxZeichen=0;"
	accept-charset="utf-8" name="text" id="text" onkeypress="enter(event);"
	class="text"
	style="background-image: url('../img/pen.png'); background-position: 698px 7px; background-repeat: no-repeat; outline: none; resize: none; width: 750px; padding: 15px; padding-left: 30px; padding-right: 30px; height: 46px; border: none;"
	cols="" rows=""></textarea> <?php
		}
	}
}
?></form>
</body>
</html>