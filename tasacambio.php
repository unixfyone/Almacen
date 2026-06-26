<?php
    $json = file_get_contents("https://ve.dolarapi.com/v1/dolares/oficial");

    // Decodificar el JSON
    $data = json_decode($json, true);

    // Obtener el valor del dólar del día más reciente
    //$dolarHoy = $data['rates'][0]['usd'];
    $dolarHoy = $data['promedio'];
?>