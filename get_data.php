<?php
// Dies ist der PHP-Endpunkt (get_data.php)

$command = "sudo rtl_433 -F json -T 30 -R 88 | grep 'VL\|VR\|HL\|HR'"; //Hier Reifensensor IDs Eintragen
$pipe = popen($command, 'r');

//Container Erstellen

$dataContainers = [
    'VL' => [],
    'VR' => [],
    'HL' => [],
    'HR' => []
];
//Daten Sortieren und zuordnen
while ($data = fgets($pipe, 4096)) {
    $json_data = json_decode($data, true);
    $id = $json_data['id'];
    $pressure = $json_data['pressure_PSI'] / 14.504;
    $pressure = number_format($pressure, 2);
    $temperature = $json_data['temperature_C'];

//Daten Sortieren ids zuordnung der Kaesten

    switch ($id) {            //Hier Auch IDs Eintragen Hier findet die zuordun statt 
        case 'Hier Eintragen VL':
            $id_text = 'VL'; 
            break;
        case 'Hier Eintragen VR':
            $id_text = 'VR';
            break;
        case 'Hier  Eintragen HR':
            $id_text = 'HR';
            break;
        case 'Hier Eintragen HL':
            $id_text = 'HL';
            break;
        default:
            $id_text = 'Nicht Erkannt!';
    }

    $dataContainers[$id_text][] = "<div> $pressure Bar</div> <div> $temperature Grad</div>";
}
pclose($pipe);

// Die Daten im JSON-Format
header('Content-Type: application/json');
echo json_encode($dataContainers);
?>

