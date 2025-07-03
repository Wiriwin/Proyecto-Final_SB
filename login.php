<?php
session_start();
require_once 'includes/config.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    if (empty($usuario) || empty($contrasena)) {
        $error = "Usuario y contraseña son requeridos";
    } else {
        $stmt = $conn->prepare("SELECT ID, Usuario, Contraseña, TipoCuenta FROM usuarios WHERE Usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $usuario_db, $contrasena_hash, $tipo_cuenta);
            $stmt->fetch();
            
            if (password_verify($contrasena, $contrasena_hash)) {
                $_SESSION['usuario'] = $usuario_db;
                $_SESSION['tipo_cuenta'] = $tipo_cuenta;
                $_SESSION['user_id'] = $id;
                
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Credenciales incorrectas";
            }
        } else {
            $error = "Credenciales incorrectas";
        }
        $stmt->close();
    }
}
$conn->close();
?>