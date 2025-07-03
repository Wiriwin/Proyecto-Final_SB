<?php
session_start();
require_once 'includes/config.php';

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);
    $confirmar_contrasena = trim($_POST['confirmar_contrasena']);
    $tipo_cuenta = $_POST['tipo_cuenta'];

    // Validaciones mejoradas
    if (empty($usuario)) {
        $error = "El nombre de usuario es requerido";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $usuario)) {
        $error = "El usuario solo puede contener letras, números y guiones bajos";
    } elseif (strlen($contrasena) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres";
    } elseif (!preg_match('/[A-Z]/', $contrasena) || !preg_match('/[0-9]/', $contrasena)) {
        $error = "La contraseña debe contener al menos una mayúscula y un número";
    } elseif ($contrasena !== $confirmar_contrasena) {
        $error = "Las contraseñas no coinciden";
    } else {
        // Verificar si el usuario ya existe
        $stmt = $conn->prepare("SELECT ID FROM usuarios WHERE Usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $error = "El nombre de usuario ya está en uso";
        } else {
            // Hash de la contraseña
            $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario
            $stmt = $conn->prepare("INSERT INTO usuarios (Usuario, Contraseña, TipoCuenta, FechaRegistro) VALUES (?, ?, ?, NOW())");
            $stmt->bind_param("sss", $usuario, $contrasena_hash, $tipo_cuenta);
            
            if ($stmt->execute()) {
                // Establecer sesión directamente después del registro
                $_SESSION['usuario'] = $usuario;
                $_SESSION['tipo_cuenta'] = $tipo_cuenta;
                $_SESSION['user_id'] = $stmt->insert_id;
                
                $success = "Registro exitoso. Redirigiendo...";
                header("refresh:2;url=dashboard.php");
            } else {
                $error = "Error al registrar el usuario: " . $conn->error;
            }
        }
        $stmt->close();
    }
    $conn->close();
}

