<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Inicio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Maquetar sección de noticias y eventos (calendario) -->
    <?php include_once "views/inc/header.php" ?>
    <main>
        <p>¡Bienvenido a Fantasy Padel! Estoy en Inicio.</p>
        <p><?php echo $_SESSION["usuario"] ?></p>
        <p><?php echo $_SESSION["id_usuario"] ?></p>
        <p><?php if (isset($_SESSION["nombreEquipo"])) echo $_SESSION["nombreEquipo"] ?></p>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>