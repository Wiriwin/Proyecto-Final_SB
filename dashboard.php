<?php
session_start();
require_once 'includes/config.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login_new_user.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .user-info {
            margin-bottom: 20px;
            padding: 15px;
            background: #f0f7ff;
            border-radius: 4px;
        }
        .logout-link {
            display: inline-block;
            margin-top: 20px;
            color: #1a73e8;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Panel de Control</h1>
        
        <div class="welcome-message">
            Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?>
        </div>
        
        <div class="user-info">
            <p><strong>Tipo de cuenta:</strong> 
                <?php 
                switch($_SESSION['tipo_cuenta']) {
                    case 'personal':
                        echo 'Uso personal';
                        break;
                    case 'hijo':
                        echo 'Para mi hijo/hija';
                        break;
                    case 'negocio':
                        echo 'Para trabajo/negocio';
                        break;
                    default:
                        echo $_SESSION['tipo_cuenta'];
                }
                ?>
            </p>
        </div>
        
        <a href="logout.php" class="logout-link">Cerrar sesión</a>
    </div>
</body>
</html>