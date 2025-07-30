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

    // Validaciones
    if (empty($usuario)) {
        $error = "El nombre de usuario es requerido";
    } elseif (!preg_match('/^[a-zA-Z0-9_]{4,20}$/', $usuario)) {
        $error = "El usuario debe tener entre 4-20 caracteres (solo letras, números y otros)";
    } elseif (strlen($contrasena) < 8) {
        $error = "La contraseña debe tener al menos 8 caracteres";
    } elseif (!preg_match('/[A-Z]/', $contrasena) || !preg_match('/[0-9]/', $contrasena) || !preg_match('/[^a-zA-Z0-9]/', $contrasena)) {
        $error = "La contraseña debe contener mayúsculas, números y un carácter especial";
    } elseif ($contrasena !== $confirmar_contrasena) {
        $error = "Las contraseñas no coinciden";
    } else {
        try {
            // Verificar si el usuario ya existe
            $stmt = $conn->prepare("SELECT ID FROM usuarios WHERE Usuario = ?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->store_result();
            
            if ($stmt->num_rows > 0) {
                $error = "El nombre de usuario ya está en uso";
                $stmt->close();
            } else {
                // Hash de la contraseña
                $contrasena_hash = password_hash($contrasena, PASSWORD_BCRYPT);
                
                // Insertar nuevo usuario (sin FechaRegistro)
                $stmt = $conn->prepare("INSERT INTO usuarios (Usuario, Contraseña, TipoCuenta) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $usuario, $contrasena_hash, $tipo_cuenta);
                
                if ($stmt->execute()) {
                    $stmt->close();
                    $success = "¡Registro exitoso! Por favor inicia sesión.";
                    // Limpiar los campos del formulario
                    $usuario = '';
                    $tipo_cuenta = 'personal';
                }
            }
        } catch (mysqli_sql_exception $e) {
            $error = "Error en el sistema. Por favor intente más tarde.";
            error_log("Error en registro: " . $e->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - Sabiduría Chapina</title>
    <link rel="stylesheet" href="css/login-styles.css">
</head>
<body>
    <div class="login-container">
        <h2>Registro de Usuario</h2>
        
        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div>
        <?php endif; ?>
        
        <?php if (!empty($success)): ?>
            <div class="alert success"><?php echo htmlspecialchars($success, ENT_QUOTES); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <div class="form-group">
                <label for="usuario">Nombre de Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php echo isset($usuario) ? htmlspecialchars($usuario, ENT_QUOTES) : ''; ?>" placeholder="Ej: usuario123" required>
                <small>4-20 caracteres (letras, números y otros)</small>
            </div>
            
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
                <small>Mínimo 8 caracteres con mayúsculas, números y un carácter especial</small>
            </div>
            
            <div class="form-group">
                <label for="confirmar_contrasena">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_contrasena" name="confirmar_contrasena" required>
            </div>
            
            <div class="form-group">
                <label for="tipo_cuenta">Tipo de Cuenta:</label>
                <select id="tipo_cuenta" name="tipo_cuenta" required>
                    <option value="personal" <?php echo (isset($tipo_cuenta)) && $tipo_cuenta == 'personal' ? 'selected' : ''; ?>>Uso personal</option>
                    <option value="hijo" <?php echo (isset($tipo_cuenta)) && $tipo_cuenta == 'hijo' ? 'selected' : ''; ?>>Para mi hijo/hija</option>
                    <option value="negocio" <?php echo (isset($tipo_cuenta)) && $tipo_cuenta == 'negocio' ? 'selected' : ''; ?>>Maestro/Tutor</option>
                </select>
            </div>
            
            <button type="submit" class="btn-register">Registrarse</button>
            
            <p class="login-link">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </form>
    </div>
</body>
</html>