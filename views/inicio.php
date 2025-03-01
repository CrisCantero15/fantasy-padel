<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Padel - Inicio</title>
</head>
<body>

    <?php

    if(!isset($_SESSION['usuario'])) {
        header("Location: " . $rutaApp . "login/accederLogin");
        exit();
    }

    ?>

    <p>¡Bienvenido a Fantasy Padel! Estoy en Inicio.</p>
    <!-- Maquetar sección de noticias y eventos (calendario) -->
     
</body>
</html>