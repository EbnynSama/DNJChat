<?php
require 'check.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script type="text/javascript" src="../js/request_online.js"></script>
<script language="javascript" type="text/javascript">
function change(o) {
if(document.getElementById(o).style.display=='none') {
document.getElementById(o).style.display='block';
 } else {
document.getElementById(o).style.display='none';
   }
 
 }
 function setFocus() {
 parent.frames['text'].document.message.text.focus();
	}
</script>
<style type="text/css">
<!--
body,html {
	margin: 0;
	padding: 0;
}

a {
	padding-top: 5px;
	padding-bottom: 5px;
	padding-left: 5px;
	padding-right: 10px;
	color: #000000;
	text-decoration: none;
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 12px;
	font-weight: bold;
}

a:hover {
	text-decoration: underline;
}

a.role {
	padding: 0;
}

a.role:hover {
	text-decoration: none;
}

div.onlineuser {
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 12px;
	background-color: #D8D8D8;
	width: 100%;
	border-bottom: 1px solid #2E2E2E;
}

div.menu-first {
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 12px;
	background-color: #E6E6E6;
	width: 100%;
	border-bottom: 1px solid #2E2E2E;
}

div.menu-second {
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 12px;
	background-color: #D8D8D8;
	width: 100%;
	border-bottom: 1px solid #2E2E2E;
}

div.first {
	padding-top: 5px;
	padding-bottom: 5px;
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 12px;
	background-color: #E6E6E6;
	border-bottom: 1px solid #2E2E2E;
}

div.second {
	padding-top: 5px;
	padding-bottom: 5px;
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 12px;
	background-color: #D8D8D8;
	border-bottom: 1px solid #2E2E2E;
}
-->
</style>
</head>
<body style="background-color: #e4e4e4;"
	onload="javascript:messageRequest('online');">
<div id="onlinelist" style="margin: 0; border: none; padding: 0;"></div>
</body>
</html>