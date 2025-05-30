<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Mercado</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/mercado.css">
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once "views/inc/header.php" ?>
    <main>
        <?php if (isset($data["mensajeModal"])): ?>
        <section id="modal">
            <div>
                <h3><?= $data["mensajeModal"] ?></h3>
                <button class="btnModal" onclick="window.location.href='<?= $rutaApp ?>mercado/accederMercado'">SEGUIR COMPRANDO</button>
                <button class="btnModal" onclick="window.location.href='<?= $rutaApp ?>equipo/accederEquipo'">IR A MI EQUIPO</button>
            </div>
        </section>
        <script>
            // Evitar el scroll del body cuando el modal está visible
            document.body.style.overflow = "hidden";
        </script>
        <?php endif; ?>
        <section id="mercado">
            <h1>MERCADO ÉLITE: TU VENTANA A LAS MEJORES INCORPORACIONES</h1>
            <h3>¡Tienes <span style="color: <?= $_SESSION["presupuestoEquipo"] > 0 ? 'green' : '#c2391b' ?>; font-weight: bold;"><?= number_format(htmlspecialchars($_SESSION["presupuestoEquipo"])) ?>€</span> listos para fichar a tus próximas estrellas!</h3>
                <table class="tablaMercado">
                    <thead>
                        <tr>
                            <th><strong>NOMBRE DEL JUGADOR</strong></th>
                            <th><strong>PUNTUACIÓN ACTUAL</strong></th>
                            <th><strong>PRECIO DE MERCADO</strong></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data["jugadores"] as $jugador): ?>
                        <tr>
                            <td><?= htmlspecialchars($jugador["nombre_jugador"]) ?></td>
                            <td><?= htmlspecialchars($jugador["puntuacion_jugador"]) ?></td>
                            <td><?= number_format(htmlspecialchars($jugador["precio"])) ?>€</td>
                            <td>
                                <form action="<?php echo $rutaApp ?>mercado/comprarJugador" method="POST">
                                    <input type="hidden" name="precioJugador" value="<?= $jugador["precio"] ?>">
                                    <input type="hidden" name="idJugador" value="<?= $jugador["id_jugador"] ?>">
                                    <button type="submit" class="boton">
                                        <i class="fas fa-shopping-cart"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
        </section>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>