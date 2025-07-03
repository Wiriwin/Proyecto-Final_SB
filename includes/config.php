<?php
$hostname = "localhost";
$username = "root";
$password = "";  // ← Vacío por defecto en WAMP
$database = "proyecto_final";

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
