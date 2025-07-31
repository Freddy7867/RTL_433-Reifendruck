## RTL_433-Reifendruck

RTL_433 zum Auslesen des Reifendrucks

Dieses Projekt bietet die Möglichkeit, Reifendrucksensoren, die mit RTL_433 kommunizieren, auszulesen und die Werte auf einer Webseite anzuzeigen.

⚠️ Hinweis:
Das Projekt befindet sich aktuell in der Entwicklung.
Derzeit besteht ein Bug, bei dem sich die Software für kurze Zeit bei der Aktualisierung aufhängt. Dieser Fehler korrigiert sich jedoch selbstständig nach einigen Minuten.

# Benötigte Hardware
RTL_433 USB-Stick
Waveshare Display (Optional)
Raspberry Pi 3B+ (getestet)

# Externe Software
RTL_433: Zum Auslesen der Sensoren = https://github.com/merbanan/rtl_433
Waveshare Software: Für das jeweilige Display; erhältlich auf der Waveshare-Webseite
Apache2: Webserver für die Webseite Installation =  sudo apt install apache2
mc: Rechteverwaltung installation = sudo apt install mc

# Konfiguration der get_data.php und Reifendruck.html
In der Datei get_data.php müssen die einzelnen IDs der Reifendrucksensoren eingetragen werden, z. B.:

Vorn Links
Vorn Rechts
Hinten Links
Hinten Rechts

in der Reifendruck.html muss die Ip_Addresse des Raspis eingetragen werden an der Erkentlichen stelle IP-ADDRESSE
# Webseitendateien

ReifendruckDSP.html:
Diese Webseite ist für Displays (Waveshare) optimiert.
Reifendruck.html:
Diese Seite verfügt über einen Zeitblock, der anzeigt, wann die nächste Aktualisierung erfolgt.

# Kopieren 
Alle Dateien müssen nach der einrichtung in den ordner var/www/html Kopert werden. Dann können diese mit der Ip_Adresse des Pi's aifgerufen werden, zb http://153.167.165:80/Reifendruck.html oder http://153.167.165:80/ReifendruckDSP.html
