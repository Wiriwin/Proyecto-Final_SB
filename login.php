<?php
session_start();
require_once 'includes/config.php';

// Si el usuario ya está logueado, redirigir al index
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    // Validaciones básicas
    if (empty($usuario)) {
        $error = "El usuario es obligatorio";
    } elseif (empty($contrasena)) {
        $error = "La contraseña es obligatoria";
    } else {
        try {
            // Buscar usuario en la base de datos (sin cerrar la conexión)
            $stmt = $conn->prepare("SELECT ID, Usuario, Contraseña, TipoCuenta FROM usuarios WHERE Usuario = ?");
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                
                if (password_verify($contrasena, $user['Contraseña'])) {
                    // Regenerar ID de sesión para prevenir fixation
                    session_regenerate_id(true);
                    
                    // Iniciar sesión
                    $_SESSION['user_id'] = $user['ID'];
                    $_SESSION['user_name'] = htmlspecialchars($user['Usuario'], ENT_QUOTES);
                    $_SESSION['user_type'] = $user['TipoCuenta'];
                    $_SESSION['loggedin'] = true;
                    
                    // Cerrar statement pero NO la conexión
                    $stmt->close();
                    
                    // Redirigir al index
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Credenciales incorrectas";
                }
            } else {
                $error = "Credenciales incorrectas";
            }
            
            // Cerrar statement si no se ha cerrado
            if (isset($stmt)) $stmt->close();
            
        } catch (Exception $e) {
            $error = "Error en el sistema. Por favor intente más tarde.";
            error_log("Error en login: " . $e->getMessage());
        }
    }
    // No cerramos $conn aquí para que permanezca abierta
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sabiduría Chapina</title>
    <link rel="stylesheet" href="css/login-styles.css">
</head>
<body>
    <div class="login-container">
        <h1>Iniciar Sesión</h1>
        
        <?php if (!empty($error)): ?>
            <div class="alert error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
         <div class="form-group">
    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" value="<?php 
        echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario'], ENT_QUOTES) : 
        (isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario'], ENT_QUOTES) : ''); 
    ?>" required autofocus>
</div>
            
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>
            
            <button type="submit">Ingresar</button>
            
            <p class="register-link">
                ¿No tienes cuenta? <a href="log_new_user.php">Regístrate aquí</a>
            </p>
        </form>
    </div>
</body>
</html>