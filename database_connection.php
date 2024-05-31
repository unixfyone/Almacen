<?php
//database_connection.php

$connect = new PDO('mysql:host=68.178.207.10:3306;dbname=unixfyonecom_db;charset=utf8', 'unixfyonecom_creverol', '+y&xZ%AunyNZ');
session_start();


// try {
//     $dsn = 'mysql:host=68.178.207.10;port=3306;dbname=unixfyonecom_db;charset=utf8';
//     $username = 'unixfyonecom_creverol';
//     $password = '+y&xZ%AunyNZ';

//     $options = [
//         PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//         PDO::ATTR_EMULATE_PREPARES   => false,
//     ];

//     $connect = new PDO($dsn, $username, $password, $options);

//     session_start();
// } catch (PDOException $e) {
//     // Manejo de errores, puedes personalizar este mensaje
//     die('Connection failed: ' . $e->getMessage());
// }

?>