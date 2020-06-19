# Database

Im Verzechnis Database befinden sich 3 SQL Skripten, in in folgender Reihenfolge ausgeführt werden müssen:

- bilddb_1: Erstellt die Datenabnk und fügt Daten ein
- changeScripts: Passt im Nachhinein überarbeitete Constraints an
- imageUser: Erstellt einen User, mit dessen Zugangsdaten die Verbindung zur Datenbank aufgebaut wird.

Alternativ kann ein anderer User die Datenbank erstellen. Dafür muss man aber die Zugangsdaten in config.php anpassen

# User zum Testen

- Adminkonto : Chuck Norris - 123
- Normaler User : if19b006 - 123

Normale User können sich auf der Website selbst ein Konto erstellen und anmelden. Für Adminberechtigungen muss das is_admin Flag in der Datenbank manuell auf 1 gesetzt werden.

#

Die Verzechnisstruktur muss erhalten bleiben, da die Skripten durch relative Pfade aufeinander verweisen. Notfalls müssen die Pfade in config.php angepasst werden.
