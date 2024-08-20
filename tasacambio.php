<?php

// URL de la API
//$url = "https://pydolarvenezuela-api.vercel.app/api/v1/dollar?page=bcv";
$url = 'http://pydolarve.org/api/v1/dollar?page=bcv';

// Inicializar cURL
$ch = curl_init($url);

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la solicitud cURL y obtener la respuesta
$response = curl_exec($ch);

// Verificar si hubo errores
if (curl_errno($ch)) {
    echo 'Error en la solicitud cURL: ' . curl_error($ch);
}

// Cerrar la sesión cURL
curl_close($ch);

// Decodificar la respuesta JSON
$data = json_decode($response, true);

// Imprimir la información del dólar estadounidense
$usdInfo = $data['monitors']['usd'];
//echo "Precio del dólar estadounidense: " . $usdInfo['price'] . PHP_EOL;
//echo "Precio antiguo del dólar estadounidense: " . $usdInfo['price_old'] . PHP_EOL;
//echo "Título del dólar estadounidense: " . $usdInfo['title'] . PHP_EOL;
$pdolar = $usdInfo['price'];