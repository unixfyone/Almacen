<?php
session_start();
$_SESSION['certificado'] = [
    'SSL_CLIENT_S_DN_CN' => $_SERVER['SSL_CLIENT_S_DN_CN'],
    // Agrega otros datos del certificado que necesites
];
// Resto de tu lógica de autenticación
?>
