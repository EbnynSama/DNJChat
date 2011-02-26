$(document).ready(function() {
	// click event f�r submit button
	('#submit').click(function() {

		// Daten von den HTML Feldern in JS-Vars �bersetzen
		var text = $('input[name=text]');

		// die Daten sollen per GET an das PHP Skript weitergeleitet werden.
		// Daf�r bauen wir einen
		// String
		var data = 'text=' + text.val();

		// alle Textfelder deaktivieren
		$('.text').attr('disabled', 'true');

		// Icon w�hrend des Requests einblenden
		$('.loading_icon').show();

		// Request abschicken
		$.ajax({
			// Ort des Skriptes in dem die per GET �bertragenen Daten
			// verarbeitet werden sollen
			url : "lib/send.php",
			// Angabe der GET Methode, auch POST w�re m�glich. Allerdings nur
			// sinnvoll
			// bei gr��eren Datenmengen
			type : "GET",
			// Daten die gesendet werden sollen
			data : data,

			// bei Antwort des Requests (Response)
			success : function(reqCode) {
				// wenn saveData.php true bzw. den Status 1 zur�ckliefert
				if (reqCode == 1) {
					// verstecken des Formulars
					$('.form').fadeOut('slow');
					// anzeigen der Erfolgsmeldung
					$('.done').fadeIn('slow');

					// wenn der Request eine Form von false zur�ckschickt,
					// Fehler ausgeben.
				} else {
					alert('Fehler beim Abschicken des Formulares.');
				}
			}
		});

		return false;
		// der return wird ben�tigt, damit das Formular nicht tats�chlich
		// abgeschickt wird und
		// sich nicht wie ein normales Form mit Seiten Refresh verh�lt.
	});
});