<?php
require 'check.php';
$currentDate = gmdate ( "D, d M Y H:i:s" ) . "GMT";
header ( "Expires: $currentDate" );
header ( "Last-Modified: $currentDate" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( 'Content-Type: text/html; charset=UTF-8' );
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
 @charset "utf-8";

body {
	margin: 0;
	padding: 0;
}

div.first {
	background-color: #D8D8D8;
	padding: 5px;
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 13px;
	margin: 0;
}

div.second {
	background-color: #E6E6E6;
	padding: 5px;
	font-family: 'Trebuchet MS', Arial, sans-serif;
	font-size: 13px;
	margin: 0;
}

img.role {
	padding-top: 2px;
}

a.convertedlink {
	color: #2E2E2E;
	text-decoration: none;
}

a.convertedlink:hover {
	color: #151515;
	text-decoration: underline;
}

.includedIMG {
	max-width: 724px;
	max-height: 190px;
	vertical-align: top;
	overflow: auto;
}
-->
</style>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/smoothscroll.js"></script>
<script type="text/javascript">
    <!--
function moves()
{
if(scrolling != false) {
window.scroll(1, 999999);
window.setTimeout("moves()", 60);
}
}
scrolling = true;
moves();
function scrollChat()
{
if(scrolling == true) {
scrolling = false;
}
else {
scrolling = true;
moves();
}
}
function scrollImage()
{
if (scrolling == false) {
parent.document.getElementById("scroll").style.display = "none";
parent.document.getElementById("stop").style.display = "inline";
}
else {
parent.document.getElementById("scroll").style.display = "inline";
parent.document.getElementById("stop").style.display = "none";
}
window.setTimeout("scrollImage()", 60);
}
scrollImage();
    //-->
  </script>
<script type="text/javascript" src="../js/request.js"></script>
</head>
<body style="background-color: #e4e4e4;"
	onload="javascript:messageRequest('log');">

<div id="inhalt" style="overflow: hidden; margin: 0; padding: 0;"></div>
</body>
</html>