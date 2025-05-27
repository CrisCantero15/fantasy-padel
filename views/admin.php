<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Administración</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/admin.css">
    <script src="../assets/js/index.js"></script>
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="logoHeader">
            <a href="<?php echo $rutaApp ?>admin/accederAdmin">
                <img src="../assets/img/logo.png" alt="Logo Padel Fantasy">
            </a>
        </div>
        <div class="textHeader">
            <h3>Vista del administrador - Tus acciones pueden comprometer el funcionamiento de la aplicación</h3>
        </div>
        <div class="btnHeader">
            <button onclick="window.location.href='<?php echo $rutaApp . 'admin/cerrarSesion'; ?>'">CERRAR SESIÓN</button>
        </div>
    </header>
    <main>
        <section id="adminPanel">
            <h1>¡Bienvenido a la Administración de Padel Fantasy!</h1>
            <div id="panel">
                <div class="panelPestanas">
                    <h3 id="pestanaEquipos" class="tituloPestana" data-contenido="contenidoEquipos">EQUIPOS</h3>
                    <h3 id="pestanaJugadores" class="tituloPestana" data-contenido="contenidoJugadores">JUGADORES</h3>
                    <h3 id="pestanaMercado" class="tituloPestana" data-contenido="contenidoMercado">MERCADO</h3>
                    <h3 id="pestanaConfiguracion" class="tituloPestana" data-contenido="contenidoConfiguracion">CONFIGURACIÓN</h3>
                </div>
                <div class="panelContenido">
                    <!-- Listado de los equipos -->
                    <div id="contenidoEquipos" class="panelTexto">
                        <table class="tablaClasificacion">
                            <thead>
                                <tr>
                                    <th>NOMBRE DEL EQUIPO</th>
                                    <th>PUNTUACIÓN TOTAL</th>
                                    <th>PRESUPUESTO</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["equipos"] as $equipo): ?>
                                <tr>
                                    <td><?= htmlspecialchars($equipo["nombre_equipo"]) ?></td>
                                    <td><?= htmlspecialchars($equipo["puntuacion_total"]) ?></td>
                                    <td><?= number_format(htmlspecialchars($equipo["presupuesto"])) . "€" ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <!-- Añadir botón para editar los datos de un equipo -->
                            </tbody>
                        </table>
                    </div>
                    <!-- Listado de los jugadores -->
                    <div id="contenidoJugadores" class="panelTexto">
                        <table class="tablaClasificacion">
                            <thead>
                                <tr>
                                    <th>NOMBRE DEL JUGADOR</th>
                                    <th>PUNTUACIÓN</th>
                                    <th>PRECIO</th>
                                    <th>¿TIENE EQUIPO?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data["jugadores"] as $jugador): ?>
                                <tr>
                                    <td><?= htmlspecialchars($jugador["nombre_jugador"]) ?></td>
                                    <td><?= htmlspecialchars($jugador["puntuacion_jugador"]) ?></td>
                                    <td><?= number_format(htmlspecialchars($jugador["precio"])) . '€' ?></td>
                                    <td><?= htmlspecialchars($jugador["en_equipo"] ? '✅' : '❌') ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <!-- Añadir un input (o botón para abrir un modal) para añadir puntuación a ese jugador o directamente editarlo -->
                                <!-- Botón para eliminar un jugador -->
                            </tbody>
                        </table>
                    </div>
                    <div id="contenidoMercado" class="panelTexto">
                        <h4>Mercado</h4>
                        <p>Aquí podrás gestionar el mercado de la aplicación.</p>
                        <!-- Aquí se pueden añadir más funcionalidades relacionadas con el mercado -->
                    </div>
                    <div id="contenidoConfiguracion" class="panelTexto">
                        <h4>Configuración</h4>
                        <p>Aquí podrás gestionar los datos principales de funcionamiento de la aplicación.</p>
                        <!-- Aquí se pueden añadir más funcionalidades relacionadas con el mercado -->
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include_once "views/inc/footer.php"; ?>
    <script>
        activarPestanas();
    </script>
</body>
</html>