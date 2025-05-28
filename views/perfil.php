<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Mi Perfil - Fantasy Padel</title>
    <!-- Fuentes de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Hoja de estilos CSS -->
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/perfil.css">
    <!-- Iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Maquetar sección de perfil del usuario -->
    <?php include_once "views/inc/header.php" ?>
    <main>
        <!-- Mejorar el CSS de esta sección con un display grid para mostrar de manera responsive el mensaje de validacion/error -->
        <form action="<?php echo $rutaApp ?>perfil/enviarDatos" method="POST" enctype="multipart/form-data">
            <div id="foto-perfil">
                <h1>IMAGEN DE PERFIL</h1>
                <div>
                    <img src="../assets/img/profile/<?php echo $_SESSION["foto_perfil"] ?>" alt="Foto de perfil del usuario">
                </div>
                <input type="file" id="image" name="image" accept="image/*">
                <?php if (isset($data["errorValidacion"])) { ?>
                    <div class="alert-text-warning">
                        <p><?php echo $data["errorValidacion"] ?></p>
                    </div>
                    <?php } 
                    if (isset($data["exitoActualizacion"])) { ?>
                    <div class="alert-text-success">
                        <p><?php echo $data["exitoActualizacion"] ?></p>
                    </div>
                <?php } ?>
            </div>
            <div id="datos-personales">
                <h1>DATOS PERSONALES</h1>
                <div id="datos-principales">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre de usuario nuevo">
                    <input type="email" id="email" name="email" placeholder="Email nuevo">
                    <input type="password" id="new-pass" name="new-pass" minlength="8" maxlength="16" placeholder="Contraseña nueva">
                    <input type="text" id="equipo" name="equipo" placeholder="Nombre del equipo">
                </div>
                <div id="insert-password">
                    <p>Para confirmar los cambios, introduce tu contraseña:</p>
                    <input type="password" id="old-pass" name="old-pass" placeholder="Contraseña">
                </div>
                <div id="boton-save">
                    <button type="submit">GUARDAR</button>
                </div>
            </div>
        </form>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>