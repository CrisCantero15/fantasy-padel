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
        <section id="adminPanel">
            <h1>¡BIENVENIDO A LA ADMINISTRACIÓN DE PADEL FANTASY!</h1>
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
                        <h3>Mercado - Añadir jugador al mercado</h3>
                        <form action="<?= $rutaApp ?>admin/anadirJugador" method="POST">
                            <h4>Para añadir un jugador al mercado, introduce su nombre y el precio. Si introduces un jugador ya existente, la aplicación lanzará un mensaje de error. Revisa bien la tabla de jugadores antes de proceder</h4>
                            <input type="text" name="nombreJugador" placeholder="Nombre del jugador" required>
                            <input type="number" name="precioJugador" placeholder="Precio del jugador" required>
                            <button type="submit"><i class="fa-solid fa-plus" style="margin-right: 10px;"></i>AÑADIR JUGADOR</button>
                            <!-- Mostrar errores al añadir jugador al mercado -->
                            <?php if (isset($data["errorMercado"])): ?>
                                <div class="alert-text-warning">
                                    <p><?php echo $data["errorMercado"] ?></p>
                                </div>
                            <?php endif; ?>
                        </form>
                    </div>
                    <div id="contenidoConfiguracion" class="panelTexto">
                        <h3>Inicio de la jornada - Actualizar la fecha de inicio de la próxima jornada</h3>
                        <form action="<?= $rutaApp ?>admin/configurarJornada" method="POST">
                            <div>
                                <h4>🔔 Aviso importante:</h4>
                                <h4>La fecha que establezcas a continuación se mostrará a los usuarios como referencia para el inicio de la próxima jornada. Sin embargo, <u>esta fecha no activa automáticamente el bloqueo de cambios en la alineación (debe realizarse en la sección inferior)</u>.</h4>
                                <h4>Inicio próxima jornada: <span class="mensajeImportante"><?= htmlspecialchars($data["configuracion"][0]["fecha_jornada"]) ?></span></h4>
                            </div>
                            <input type="datetime-local" name="fechaJornada" required>
                            <button type="submit">ACTUALIZAR JORNADA</button>
                        </form>
                        <hr>
                        <h3>Alineación - Activar o desactivar la alineación</h3>
                        <div class="configuracionAlineacion">
                            <h4>👉 Para aplicar realmente la restricción que impide modificar el equipo titular o vender jugadores, el administrador debe pulsar manualmente el botón de activación/desactivación más abajo en el panel.</h4>
                            <?php if ($data["configuracion"][0]["modif_titulares"]): ?>
                            <div>
                                <h4>Estado actual: <span style="color: green;">ACTIVADO</span> ✅</h4>
                                <button class="btn" onclick="window.location.href='<?php echo $rutaApp ?>admin/desactivarAlineacion'">DESACTIVAR</button>
                            </div>
                            <?php else: ?>
                            <div>
                                <h4>Estado actual: <span style="color: #c2391b;">DESACTIVADO</span> ❌</h4>
                                <button class="btn" onclick="window.location.href='<?php echo $rutaApp ?>admin/activarAlineacion'">ACTIVAR</button>
                            </div>
                            <?php endif; ?>
                            <!-- Mostrar errores al añadir jugador al mercado -->
                            <?php if (isset($data["errorConfiguracion"])): ?>
                            <div class="alert-text-warning">
                                <p><?php echo $data["errorConfiguracion"] ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
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