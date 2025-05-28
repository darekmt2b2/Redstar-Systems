<?php

$servidor = "localhost";     // Dirección del servidor, si es local, usar 'localhost'
$usuario = "darekTFG";     // Tu usuario de la base de datos
$contraseña = "Australia_2032"; // La contraseña de tu base de datos
$baseDatos = "redstarairways";    // El nombre de la base de datos (en tu caso 'hackathon')
 
$conexion = new mysqli($servidor, $usuario, $contraseña, $baseDatos);
 
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
 
$conexion->set_charset("utf8");

?>