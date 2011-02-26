<html>
<head>
<script type="text/javascript">
// JavaScript-Ladebalken mit Prozent-Anzeige
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
	document.getElementById("content").style.display = "block";
 }
}
</script>
</head>
<body onload="javascript:load3('400');"
	style="font-family: 'Trebuchet MS', Arial, sans-serif; font-size: 12px;">
<div id="LoadBar"
	style="padding: 25px; background-color: #e4e4e4; border: solid 1px #000000; display: block; width: 425px; margin-left: auto; margin-right: auto;">
<div
	style="margin-left: auto; margin-right: auto; position: relative; width: 400px; background-color: #C0C0C0; border: solid 1px #000000;">
<span
	style="position: absolute; width: 100%; z-index: 3; text-align: center; font-weight: bold;">Fortschritt:&nbsp;<span
	id="counter3">0%</span></span>
<div id="status3"
	style="position: relative; background-image: url('bar.png'); background-color: red; width: 0px; height: 22px; border-right: solid 1px #000000; z-index: 2;">&thinsp;</div>
</div>
<div id="content" style="display: none; text-align: center;">Hier
entsteht eine neue Internetpräsents des Unternehmens<br />
Event & Marketing Texte</div>
</div>
</body>
</html>