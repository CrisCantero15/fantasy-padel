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
        <!-- Añadir modal que se abre al comprar un jugador y con dos botones (permanecer en el mercado o ir a equipo) -->
        <!-- En ese modal tratar el error en caso de que el jugador ya haya sido comprado justo antes por otro usuario -->
        <section id="mercado">
            <h1>Mercado Élite: Tu ventana a las mejores incorporaciones</h1>
            <?php
                if (isset($data["errorMercado"])) {
                    echo "<div class='error'><h4>" . $data["errorMercado"] . "</h4></div>";
                } else {
            ?>
            <!-- Falta por terminar de implementar la compra del jugador - Sería añadir el jugador en la plantilla del usuario y eliminarlo de la tabla 'mercado' -->
            <form action="<?php echo $rutaApp ?>mercado/comprarJugador" method="POST">
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
                            <td><?= htmlspecialchars($jugador["precio"]) ?>€</td>
                            <td><button type="submit" name="comprar" value="<?= $jugador["id_jugador"] ?>" class="btnCompra"><i class="fas fa-shopping-cart"></i></button></td>
                        </tr>
                    <?php endforeach; } ?>
                    </tbody>
                </table>
            </form>
        </section>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>