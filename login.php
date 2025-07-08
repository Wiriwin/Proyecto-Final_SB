<?php
session_start();
require_once 'includes/config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    // Validación básica
    if (empty($usuario) || empty($contrasena)) {
        $error = "Usuario y contraseña son obligatorios";
    } else {
        // Buscar usuario en la base de datos
        $stmt = $conn->prepare("SELECT ID, Usuario, Contraseña, TipoCuenta FROM usuarios WHERE Usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            
            // Verificar contraseña
            if (password_verify($contrasena, $user['Contraseña'])) {
                // Iniciar sesión
                $_SESSION['user_id'] = $user['ID'];
                $_SESSION['user_name'] = $user['Usuario'];
                $_SESSION['user_type'] = $user['TipoCuenta'];
                $_SESSION['loggedin'] = true;
                
                // Redirigir según tipo de cuenta
                if ($user['TipoCuenta'] == 'admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    header("Location: user_dashboard.php");
                }
                exit();
            } else {
                $error = "Contraseña incorrecta";
            }
        } else {
            $error = "Usuario no encontrado";
        }
        
        $stmt->close();
    }
    
    $conn->close();
}
?>
