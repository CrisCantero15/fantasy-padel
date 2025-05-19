<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Clasificación</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/clasificacion.css">
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once "views/inc/header.php" ?>
    <main>
        <section id="clasificacion">
            <h1>¿Quién lidera el fantasy? ¡Así va la liga!</h1>
            <?php
                if (isset($data["errorClasificacion"])) {
                    echo "<div class='error'><h4>" . $data["errorClasificacion"] . "</h4></div>";
                } else {
            ?>
            <table class="tablaClasificacion">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><strong>PUNTUACIÓN TOTAL</strong></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $posicion = 1;
                        foreach ($data["equipos"] as $equipo):
                    ?>
                    <tr>
                        <td><?php echo $posicion; ?></td>
                        <td style="text-align: left;"><img class="logoEquipo" src="../assets/img/profile/<?php echo $equipo["foto_perfil"] ?>" alt="Logo equipo" style="width: 30px; height: 30px"><?= htmlspecialchars($equipo["nombre_equipo"]) ?></td>
                        <td style="text-align: left;"><?= htmlspecialchars($equipo["nombre"]) ?></td>
                        <td><?= htmlspecialchars($equipo["puntuacion_total"]) ?></td>
                    </tr>
                    <?php 
                        $posicion++;
                        endforeach; }
                    ?>
                </tbody>
            </table>
            <!-- Maquetar sección de la clasificación de la liga -->
        </section>
    </main>
    <?php include_once "views/inc/footer.php" ?>
</body>
</html>