<?php 
$env = parse_ini_file('.env');

// Asigna las variables de entorno a constantes
define('DB_HOST', $env['DB_HOST']);
define('DB_PORT', $env['DB_PORT']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
define('FILE_ROOT', $env['File_Root']); // Corregido: mayúsculas y minúsculas en el nombre de la constante

// Función para conectarse a la base de datos
function conectarse()
{
    $link = mysqli_init();
    mysqli_ssl_set($link, NULL, NULL, FILE_ROOT, NULL, NULL); // Corregido: uso de la constante FILE_ROOT
    mysqli_real_connect($link, DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT, MYSQLI_CLIENT_SSL);
   
    return $link; 
}

?>