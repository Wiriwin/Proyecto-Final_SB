<?php
// Iniciar el búfer de salida para evitar problemas con las cabeceras
ob_start();
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location:/login.php"); // Usar URL absoluta
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/universal-styles.css">
    <link rel="stylesheet" href="css/index-styles.css">
    <title>Sabiduría Chapina</title>
</head>
<body>
    <header>
        <div class="hamburger-abrir" id="hamburger-abrir">
            <span class="bar-abrir"></span>
            <span class="bar-abrir"></span>
            <span class="bar-abrir"></span>
        </div>
        
        <a href="log_new_user.php"><button class="boton">Registrarse</button></a>
        <a href="logout.php"><button class="boton">Cerrar Sesión</button></a>
    </header>

    <section class="center">
        <h1 class="titulo-bienvenida">Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario', ENT_QUOTES, 'UTF-8'); ?></h1>
        <img src="img/arcoiris.png" class="arcoiris" alt="Arcoíris">
    </section>

    <div class="fondo-nubes">
        <img src="img/nube1.png" class="nubes2" id="nubes" alt="Nube">
        <img src="img/nube1.png" class="nubes3" id="nubes" alt="Nube">
        <img src="img/nube1.png" class="nubes4" id="nubes" alt="Nube">
    </div>

    <div>
        <img src="img/maripLeft.png" class="maripLeft" alt="Mariposa izquierda">
        <img src="img/maripRight.png" class="maripRight" alt="Mariposa derecha">
    </div>

    <div class="footer">
        <img src="img/niños.png" class="niños" alt="Niños">
        <img src="img/cesped1.png" class="cesped2" alt="Césped">
        <img src="img/cesped1.png" class="cesped" alt="Césped">
    </div>

    <div class="nav-list" id="nav-list">
        <div class="hamburger-cerrar" id="hamburger-cerrar">
            <span class="bar-cerrar1"></span>
            <span class="bar-cerrar2"></span>
        </div>
        <div class="LCAC">
            <ul>
                <li><a href="Grados.php">Grados</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>

    <script src="js/script.js"></script>
<?php
// Liberar el búfer de salida
ob_end_flush();
?>
</body>
</html>