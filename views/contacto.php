<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Padel - Contacto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/contacto.css">
</head>
<body>
    <header>
        <div><a href="<?php echo $rutaApp ?>/inicio/accederInicio"><img src="../assets/img/logo.png" alt="Logo Fantasy Padel"></a></div>
        <div>
            <p>¡Forma tu equipo en Fantasy Padel y conquista la pista!</p>
        </div>
    </header>
    <main>
        <section>
            <div class="form-contact">         
                <div class="text-form">
                    <h1>Contacto</h1>
                    <h2>Si tienes alguna incidencia o sugerencia, por favor, escríbenos</h2>
                </div>
                <form action="<?php echo $rutaApp ?>contacto/establecerContacto" method="POST">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <select name="motivo" id="motivo">
                        <option value="" selected>Motivo de la consulta</option>
                        <option value="funcionamiento">Funciona mal la página web</option>
                        <option value="sugerencia">Tengo una idea para mejorar la aplicación</option>
                        <option value="colaboración">Me gustaría colaborar con el proyecto</option>
                        <option value="otro">Otros</option>
                    </select>
                    <textarea id="mensaje" name="mensaje" maxlength="255" placeholder="Escribe tu incidencia..." required></textarea>
                    <?php if (isset($data["errorEnvio"])) { ?>
                    <div class="alert-text-warning">
                        <p><?php echo $data["errorEnvio"] ?></p>
                    </div>
                    <?php } 
                    if (isset($data["exitoEnvio"])) { ?>
                    <div class="alert-text-success">
                        <p><?php echo $data["exitoEnvio"] ?></p>
                    </div>
                    <?php } ?> 
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </section>
    </main>
    <!-- Añadir el footer aquí -->
</body>
</html>