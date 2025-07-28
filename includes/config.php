<?php
// Configuración de conexión a la base de datos
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'proyecto_final';

// Establecer conexión
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar conexión
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }
    
    // Configurar el conjunto de caracteres
    if (!$conn->set_charset("utf8")) {
        throw new Exception("Error al establecer charset: " . $conn->error);
    }
    
    // Habilitar reporte de errores
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    
} catch (Exception $e) {
    // Registrar el error y mostrar mensaje genérico
    error_log("Error en config.php: " . $e->getMessage());
    die("Error en el sistema. Por favor intente más tarde.");
}

// No cerramos la conexión aquí, se cerrará automáticamente al final del script
?>