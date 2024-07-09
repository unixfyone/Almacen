<?php
//database_connection.php
$env = parse_ini_file('.env');

$host = $env['DB_HOST'];
$port = $env['DB_PORT'];
$database = $env['DB_NAME'];
$username = $env['DB_USER'];
$password = $env['DB_PASSWORD'];

$connect = new PDO("mysql:host=$host;dbname=$database", $username, $password);
session_start();


//if((time() - $_SESSION['time']) > 5){
//    header('location: logout_page.php');
//} 
?>