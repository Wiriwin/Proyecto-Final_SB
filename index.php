<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="css\universal-styles.css">
    <link rel="Stylesheet" href="css\index-diseño.css">
    <title>Sabiduria Chapina</title>
</head>
<body>
    <header>
            <div class="hamburger-abrir" id="hamburger-abrir">
                <span class="bar-abrir"></span>
                <span class="bar-abrir"></span>
                <span class="bar-abrir"></span>
            </div>
                
            <a href=""><button class="boton">Registrarse</button></a>
    </header>

    <section class="center">
        <img src="img\arcoiris.png" class="arcoiris">
    </section>

    <div class="fondo-nubes">
        <img src="img\nube1.png" class="nubes" id="nubes">

        <img src="img\nube1.png" class="nubes2" id="nubes">

        <img src="img\nube1.png" class="nubes3" id="nubes">

        <img src="img\nube1.png" class="nubes4" id="nubes">
    </div>

    <div>
        <imf src="img/maripLeft.png" class="maripLeft">
        <imf src="img/maripRight.png" class="maripRight">
    </div>
    <div class="footer">
        <img src="img/niños.png" class="niños">
        <img src="img/cesped1.png" class="cesped2">
        <img src="img/cesped1.png" class="cesped">
    </div>

    <div class="nav-list" id="nav-list">
        <div class="hamburger-cerrar" id="hamburger-cerrar">
            <span class="bar-cerrar1"></span>
            <span class="bar-cerrar2"></span>
        </div>
        <div class="LCAC">
            <li><a href="Grados.php">Grados</a></li><br>
            <li><a href="Contactos.php">Contactanos</a></li><br>
            <li><a href="">Cerrar Sesion</a></li>
        </div>
    </div>

    <script src="js\script.js"></script>
</body>
</html>

<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="css\universal-style.css">
    <link rel="Stylesheet" href="css\index-style.css">
    <title>Sabiduria Chapina</title>
</head>
<body>
    <header>
            <div class="hamburger-abrir" id="hamburger-abrir">
                <span class="bar-abrir"></span>
                <span class="bar-abrir"></span>
                <span class="bar-abrir"></span>
            </div>
                
            <a href="logout.php"><button class="boton">Cerrar Sesión</button></a>
    </header>

    <section class="center">
        <img src="img\arcoiris.png" class="arcoiris">
        <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h1>
    </section>