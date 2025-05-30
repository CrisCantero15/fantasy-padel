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
    <script src="../assets/js/index.js"></script>
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once "views/inc/header.php" ?>
    <?php if (isset($data["peticionNoAutorizada"])): ?>
        <script>
            iniciarAlertaGET("<?= addslashes($data['peticionNoAutorizada']) ?>");
        </script>
    <?php endif; ?>
    <main>
        <!-- Modales -->
            <!-- Primer modal: ¿seguro que quieres vender este jugador? -->
        <!-- Sección de equipo -->
        <section id="equipo">
            <h1>¡ESTE ES TU EQUIPO GANADOR!</h1>
            <div id="contenedorEquipo">
                <div class="infoEquipo">
                    <h2>
                        <img class="logoEquipo" src="../assets/img/profile/<?php echo $_SESSION["foto_perfil"] ?>" alt="Logo equipo" style="width: 30px; height: 30px">
                        <span class="mensajeImportante"><?= $_SESSION["nombreEquipo"] ?></span>
                    </h2>
                    <h2>
                        Presupuesto actual: 
                        <span style="color: <?= $_SESSION["presupuestoEquipo"] > 0 ? 'green' : '#c2391b' ?>;">
                            <?= number_format(htmlspecialchars($_SESSION["presupuestoEquipo"])) ?>€
                        </span>
                    </h2>
                    <h2>
                        Próxima jornada: <span class="mensajeImportante"><?= htmlspecialchars($_SESSION["fechaProximaJornada"]) ?></span>
                    </h2>
                    <h2>
                        Modificación de titulares: 
                        <span>
                            <?php echo $_SESSION["modificarTitulares"] ? "✅" : "❌"; ?>
                        </span>
                    </h2>
                </div>
                <?php if (!isset($data["errorJugadores"])): ?>
                <div class="listaJugadores">
                    <?php if (isset($data["jugadoresEquipo"])): ?>
                        <?php foreach ($data["jugadoresEquipo"] as $jugador): ?>
                    <h3 class="<?= $jugador['en_titular'] ? 'jugadorTitular' : '' ?>">
                        <?=
                            htmlspecialchars($jugador["nombre_jugador"]) . " | " .
                            htmlspecialchars($jugador["puntuacion_jugador"]) . " | " .
                            number_format(htmlspecialchars($jugador["precio"])) . "€ | "
                        ?>
                        <?php if ($jugador["en_titular"] == true): ?>
                             <button class="boton" onclick="window.location.href='<?= $rutaApp ?>equipo/quitarJugador?id=<?= $jugador['id_jugador'] ?>'"><i class="fas fa-user-slash"></i></button>
                        <?php else: ?>
                            <button class="boton" onclick="window.location.href='<?= $rutaApp ?>equipo/seleccionarJugador?id=<?= $jugador['id_jugador'] ?>'"><i class="fas fa-star"></i></button>
                        <?php endif; ?>
                        <button class="boton" onclick="window.location.href='<?= $rutaApp ?>equipo/venderJugador?id=<?= $jugador['id_jugador'] ?>'"><i class="fas fa-shopping-cart"></i> Vender</button>
                    </h3>
                    <hr>
                    <?php 
                        endforeach;
                    else:
                    ?>
                    <!-- Mensaje por si no hay jugadores en el equipo -->
                    <h3>No existen jugadores en el equipo, ¡igual deberías ir al mercado!</h3>
                    <?php endif; ?>
                    <!-- Error para cuando no se puede seleccionar nuevos jugadores titulares -->
                    <?php if (isset($data["errorTitular"])): ?>
                    <div class="alert-text-warning">
                        <p><?php echo $data["errorTitular"] ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="seleccionJugadores">
                    <?php                    
                        $contadorTitulares = 0;
                        if (isset($data["jugadoresEquipo"])):
                            foreach ($data["jugadoresEquipo"] as $jugador):
                                if ($jugador["en_titular"] == true):
                                    echo "<div class='jugadorSeleccionado mensajeImportante'><p>" . htmlspecialchars($jugador["nombre_jugador"]) . "</p></div>";
                                    $contadorTitulares++;
                                endif;
                            endforeach;
                        endif;
                        while($contadorTitulares < 4):
                            echo "<div class='jugadorSeleccionado' style='color: black;'><p></p></div>";
                            $contadorTitulares++;
                        endwhile;
                    ?>
                </div>
            </div>
            <!-- Error para cuando no existen jugadores en el equipo o existe algún fallo en su búsqueda en la BBDD -->
            <?php else: ?>
            <div class="alert-text-warning">
                <p><?php echo $data["errorJugadores"] ?></p>
            </div>
            <?php endif; ?>
        </section>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>