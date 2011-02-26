function messageRequest(src) {
	http_request = false;
	if (window.XMLHttpRequest) {
		http_request = new XMLHttpRequest();
		if (http_request.overrideMimeType) {
			http_request.overrideMimeType('text/xml');
		}
	} else if (window.ActiveXObject) { // IE
		try {
			http_request = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			try {
				http_request = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
			}
		}
	}
	if (!http_request) {
		alert('Das Request Objekt konnte nicht erzeugt werden! Bitte ueberpruefen Sie Ihre JAVASCRIPT Einstellungen!');
		return false;
	}

	http_request.onreadystatechange = show;
	http_request.open('GET', src + '.php', true);
	http_request.send(null);
}

function show() {
	if (http_request.readyState == 4) {
		window.setTimeout('messageRequest("log")', 120);
		document.getElementById("inhalt").innerHTML = http_request.responseText;
	}
}