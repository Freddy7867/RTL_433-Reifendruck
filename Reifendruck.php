<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reifendruck</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Verhindert horizontales Scrollen */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        img {
            width: 250px;
            height: 455px;
            transform: rotate(180deg);
        }

        .data-container {
            position: absolute;
            display: flex;
            flex-direction: column;
            gap: 5px;
            padding: 10px;
        }

        .data-container.VL {
            top: 0;
            left: 0;
        }

        .data-container.VR {
            top: 0;
            right: 0;
        }

        .data-container.HL {
            bottom: 0;
            left: 0;
        }

        .data-container.HR {
            bottom: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <!-- Foto in der Mitte -->
    <div>
        <img src="Auto.jpg" alt="Photo">
    </div>

    <!-- Container um das Bild herum -->
    <div class="data-container VL" id="VL-container">Suche Daten...</div>
    <div class="data-container VR" id="VR-container">Suche Daten...</div>
    <div class="data-container HL" id="HL-container">Suche Daten...</div>
    <div class="data-container HR" id="HR-container">Suche Daten...</div>

    <script>
        var previousData = {
            'VL': document.getElementById('VL-container').innerHTML,
            'VR': document.getElementById('VR-container').innerHTML,
            'HL': document.getElementById('HL-container').innerHTML,
            'HR': document.getElementById('HR-container').innerHTML
        };

        // Funktion, die die Daten aktualisiert
        function updateData() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_data.php', true); // get_data.php ist der PHP-Endpunkt
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var responseData = JSON.parse(xhr.responseText);
                    if (!isEqual(previousData, responseData)) { // schauen ob die daten gleichen
                        updateContainers(responseData);
                        previousData = responseData;
                    }
                }
            };
            xhr.send();
        }

        // Aktualisieren der Container
        function updateContainers(data) {
            var containers = ['VL', 'VR', 'HL', 'HR'];
            containers.forEach(function (containerId) {
                var container = document.getElementById(containerId + '-container');
                if (data[containerId].length > 0) {
                    var newData = data[containerId][0]; // Nur den ersten Datensatz verwenden
                    var div = document.createElement('div');
                    div.innerHTML = newData;
                    container.innerHTML = ''; // Container leeren
                    container.appendChild(div);

 // Benachrichtigung "Reifendruck aktualisiert"
            container.innerHTML = "Reifendruck aktualisiert";
            setTimeout(function() {
                container.innerHTML = newData;
            }, 2000);

           }
        });
      }

        // Funktion ob zwei Objekte gleich sind
        function isEqual(obj1, obj2) {
            return JSON.stringify(obj1) === JSON.stringify(obj2);
        }

        // Daten alle 10 Sekunden aktualisieren
        setInterval(updateData, 10000);

        // Initialdaten laden
        updateData();
    </script>
</body>
 </html>

