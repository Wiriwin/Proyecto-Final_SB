<?php
// Configuración de conexión
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$bd = 'proyecto_final';

$conn = new mysqli($host, $usuario, $contrasena, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Habilitar excepciones para MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Procesamiento del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    
    try {
        // Hashear la contraseña
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
        
        // Preparar la consulta
        $stmt = $conn->prepare("INSERT INTO usuarios (Usuario, Contrasena) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $contrasena_hash);
        
        // Ejecutar dentro del bloque try
        $stmt->execute();
        echo "¡Registro exitoso!";
        
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) {
            // Error de duplicado
            echo "El nombre de usuario '$usuario' ya está en uso. Por favor elige otro.";
        } else {
            // Otros errores SQL
            echo "Error al registrar: " . $e->getMessage();
        }
    } finally {
        // Cerrar conexiones siempre
        if (isset($stmt)) $stmt->close();
        $conn->close();
    }
}
?>