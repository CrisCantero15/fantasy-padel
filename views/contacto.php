<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Padel - Contacto</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <!-- Añadir el header aquí -->
    <main>
        <section>
            <div class="form-container">             
                <div class="text-form">
                    <h1>Contacto</h1>
                    <p>Si tienes alguna incidencia o sugerencia, por favor, escríbenos</p>
                </div>
                <form action="<?php echo $rutaApp ?>contacto/enviarCorreo" method="POST">
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <textarea id="mensaje" name="mensaje" placeholder="Escribe tu incidencia..."></textarea>
                    <?php if (isset($data["errorEnvio"])) { ?>
                    <div class="alert-text">
                        <p><?php echo $data["errorEnvio"] ?></p>
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