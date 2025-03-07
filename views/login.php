<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Padel - Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</head>
<body>
    <main class="main-container">
        <section class="login-container">
            <div class="logo-container">
                <img src="../assets/img/logo.png" alt="Logo Fantasy Padel">
            </div>
            <div class="form-container">             
                <div class="text-form">
                    <p>Empieza tu aventura</p>
                    <h1>Inicia sesión en Padel Fantasy</h1>
                </div>
                <form action="<?php echo $rutaApp ?>login/validarLogin" method="POST">
                    <input type="text" id="usuario" name="usuario" placeholder="Nombre de usuario">
                    <input type="password" id="contrasena" name="contrasena" placeholder="Contraseña">
                    <?php if (isset($data["errorValidacion"])) { ?>
                    <div class="alert-text">
                        <p><?php echo $data["errorValidacion"] ?></p>
                    </div>
                    <?php } ?>  
                    <button type="submit">Iniciar sesión</button>
                </form>
                <div class="text-form">
                    <p>¿No tienes una cuenta? <a href="<?php echo $rutaApp ?>registro/accederRegistro" >Regístrate</a></p>
                    <p>¿Tienes algún problema al iniciar sesión? <a href="<?php echo $rutaApp ?>contacto/accederContacto" >Contáctanos</a></p>
                </div>
            </div>
        </section>
        <section class="portada-container">
            <img class="img-padel" src="../assets/img/portada.jpg" alt="Portada Fantasy Padel">
        </section>
    </main>
</body>
</html>