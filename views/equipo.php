<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Plantilla</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/equipo.css">
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once "views/inc/header.php" ?>
    <main>
        <section id="equipo">
            <h1>¡Este es tu equipo ganador!</h1>
            <div id="contenedorEquipo">
                <div class="infoEquipo">
                    <h2>
                        <img class="logoEquipo" src="../assets/img/profile/<?php echo $_SESSION["foto_perfil"] ?>" alt="Logo equipo" style="width: 30px; height: 30px">
                        <!-- Añadir color al presupuesto (si es positivo, en verde; si es negativo, en rojo) -->
                        <?= $_SESSION["nombreEquipo"] ?>
                    </h2>
                    <h2>
                        <?= "Presupuesto actual: " . $_SESSION["presupuestoEquipo"] . "€" ?>
                    </h2>
                    <!-- Añadir la fecha de la próxima jornada (contador o fecha de cierre de selección de jugadores) -->
                    <h2>Próxima jornada: (...)</h2>
                </div>
                <div class="listaJugadores">
                    <!-- Añadir un foreach con el listado de los jugadores que pertenecen al equipo -->
                    <h3>Jugador 1 - Puntuación | Valor</h3>
                    <h3>Jugador 2 - Puntuación | Valor</h3>
                    <h3>Jugador 3 - Puntuación | Valor</h3>
                    <h3>Jugador 4 - Puntuación | Valor</h3>
                    <h3>Jugador 5 - Puntuación | Valor</h3>
                    <h3>Jugador 6 - Puntuación | Valor</h3>
                </div>
                <div class="seleccionJugadores">
                    <!-- Poner botones que te abra un listado con los jugadores y al hacer clic se selecciona -->
                    <div class="jugadorSeleccionado">Jugador 1</div>
                    <div class="jugadorSeleccionado">Jugador 2</div>
                    <div class="jugadorSeleccionado">Jugador 3</div>
                    <div class="jugadorSeleccionado">Jugador 4</div>
                </div>
                <!-- Añadir mensajes de alertas para informar al usuario de todo (por ejemplo, de que faltan jugadores por seleccionar) -->
            </div>
        </section>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>