<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Registro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/registro.css">
</head>
<body>
    <!-- Maquetar sección de registro de un nuevo usuario -->
    <!-- Para esta sección crear el formulario de registro y, al enviar el formulario, abrir un modal con el resultado (ok / error) -->
    <main>
        <section>
            <div id="logo-register">
                <!-- Insertar el logo de la página para volver al index.php -->
            </div>
            <div class="form-register">
                <div class="text-form">
                    <h1>¿Listo para ser el mejor mánager de padel?</h1>
                    <h2>Rellena los campos... ¡y que comience el juego!</h2>
                </div>
                <form action="<?php echo $rutaApp ?>registro/validarRegistro" method="POST">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" autocomplete="username" required>
                    <input type="email" id="email" name="email" placeholder="Email" autocomplete="email" required>
                    <input type="password" id="password" name="password" minlength="8" maxlength="16" placeholder="Contraseña" autocomplete="new-password" required>
                    <input type="password" id="confirmarPassword" name="confirmarPassword" placeholder="Confirmar contraseña" autocomplete="new-password" required>
                    <?php if (isset($data["errorRegistro"])) { ?>
                    <div class="alert-text-warning">
                        <p><?php echo $data["errorRegistro"] ?></p>
                    </div>
                    <?php } ?>
                    <button type="submit">Enviar</button>
                </form>
            </div>
            <?php if (isset($data["exitoRegistro"])) { ?>
            <div id="modal-register">
                <div>
                    <h1>¡Registro completado!</h1>
                    <p><?php echo $data["exitoRegistro"] ?></p>
                    <button id="btn-modal" onclick="window.location.href='<?php echo $rutaApp ?>registro/iniciarLogin'">Iniciar sesión</button>
                </div>
            </div>
            <?php } ?>
        </section>
    </main>
</body>
</html>