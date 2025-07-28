<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="Stylesheet" href="css\universal-styles.css">
    <link rel="Stylesheet" href="css\Lecciones-diseño.css">
    <title>Lecciones</title>
</head>
<body>
    <div>
        <img src="img\maripLeft.png" class="maripLeft">
        <img src="img\maripRight.png" class="maripRight">
    </div>

    <header>
        <div class="hamburger-abrir" id="hamburger-abrir">
            <span class="bar-abrir"></span>
            <span class="bar-abrir"></span>
            <span class="bar-abrir"></span>
        </div>
                
    </header>
    <div class="title">
        <h1>Lecciones</h1>
    </div>

    <section class="botones">
        <a href="CS3.php">
            <button class="boton" id="L">
                <img src="img\CS.png" class="boton-act" id="boton-act">
                <p>Ciencias <br>Sociales</p>
            </button>
        </a>
        <a href="Math3.php">
            <button class="boton" id="A">
                <img src="img\Mate.png" class="boton-act2" id="boton-act">
                <p class="p2">Matemáticas</p>
            </button>
        </a>
    </section>
    <section class="botones2">
        <a href="CN3.php">
            <button class="boton" id="J">
                <img src="img\CN.png" class="boton-act3" id="boton-act">
                <p class="p3">Ciencias <br>Naturales</p>
            </button>
        </a>
        <a href="IE3.php">
            <button class="boton" id="D">
                <img src="img\IE.png" class="boton-act4" id="boton-act">
                <p class="p4">Idioma <br>Español</p>
            </button>
        </a>
    </section>
    <div class="nav-list" id="nav-list">
        <div class="hamburger-cerrar" id="hamburger-cerrar">
            <span class="bar-cerrar1"></span>
            <span class="bar-cerrar2"></span>
        </div>
        <div class="LCAC">
            <li><a href="index.php">Inicio</a></li><br>
            <li><a href="Grados.php">Grados</a></li><br>
            <li><a href="Contactos.php">Contactanos</a></li><br>
            <li><a href="">Cerrar Sesion</a></li>
        </div>
    </div>

    <script src="js\script.js"></script>
</body>
</html>