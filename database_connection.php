<?php
// Configuración de la base de datos
$env = parse_ini_file('.env');

$host = $env['DB_HOST'];
$port = $env['DB_PORT'];
$dbname = $env['DB_NAME'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];
$ssl_cert = $env['File_Root'];

try {

 //   $connect = mysqli_init();
 //   mysqli_ssl_set($connect, NULL, NULL, $ssl_cert, NULL, NULL);
 //   mysqli_real_connect($connect, "produfodb.mysql.database.azure.com", "ufoglobal", "{$password}", "{$dbname}", 3306, MYSQLI_CLIENT_SSL);
    //echo "<pre>"; print_r($password); exit();
 //  session_start();


    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $options = [
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_SSL_CA => $ssl_cert, // Ruta al certificado CA
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true, // Activa/Desactiva la verificación del certificado del servidor
    ];
   
    $connect = new PDO($dsn, $username, $password, $options);
    session_start();
 
    // Realiza operaciones en la base de datos aquí...

    // Cierra la conexión
 //   $connect = null;
} catch (PDOException $e) {
    echo "Error al conectar: " . $e->getMessage();
}

?>