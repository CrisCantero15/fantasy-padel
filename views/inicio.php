<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/logo.png" type="image/png">
    <title>Fantasy Padel - Inicio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/inicio.css">
    <script src="../assets/js/index.js"></script>
    <script src="https://kit.fontawesome.com/aaf2ef96dc.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Maquetar sección de noticias y eventos (calendario) -->
    <?php include_once "views/inc/header.php" ?>
    <main>
        <!-- Modal para registrar equipo (se inicia el modal en caso de que no exista nombre del equipo - Esto tratarla en el controlador para ver si hay o no un equipo registrado en la BBDD) -->
        <?php if (!isset($_SESSION["nombreEquipo"])) { ?>
            <div class="modal">
                <div>
                    <h1>¿Aún no tienes un equipo registrado?</h1>
                    <p>¡No te preocupes! Puedes registrarlo ahora mismo. Para ello, introduce el nombre de tu equipo y pulsa en el botón "Añadir equipo".</p>
                    <form action="<?php echo $rutaApp ?>inicio/registrarEquipo" method="POST">
                        <input type="text" id="nombreEquipo" name="nombreEquipo" placeholder="Nombre del equipo" required>
                        <?php
                        if (isset($data["errorValidacion"])) { ?>
                            <div class="alert-text-warning">
                                <p><?php echo $data["errorValidacion"] ?></p>
                            </div>
                        <?php } ?>
                        <button class="btn-modal" type="submit">Añadir equipo</button>
                    </form>
                </div>
            </div>
        <?php } 
        if (isset($data["exitoRegistro"])) { ?>
            <div class="modal">
                <div>
                    <h1>¡Equipo registrado!</h1>
                    <p><?php echo $data["exitoRegistro"] ?></p>
                    <button class="btn-modal" onclick="window.location.href='<?php echo $rutaApp ?>mercado/accederMercado'">Ir al mercado</button>
                </div>
            </div>
        <?php } ?>
        <section id="instrucciones">
            <h1>Tu aventura en el pádel comienza aquí, ¡empieza a jugar y ganar!</h1>
            <div id="acordeonInfo">
                <div class="pestanaAcordeon">
                    <div class="headAcordeon">
                        <h3>¿Qué es Padel Fantasy?</h3>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="contenidoAcordeon">
                        <p><strong>Padel Fantasy</strong> es un juego virtual basado en el circuito profesional de pádel. Los usuarios asumen el rol de mánagers y crean su propio equipo eligiendo a jugadores reales, ajustándose a un presupuesto ficticio.</p>
                        <p>Cada semana, el rendimiento real de esos jugadores en los torneos se transforma en puntos. Así, puedes competir con otros usuarios, demostrar tus conocimientos del pádel y escalar posiciones en la clasificación general.</p>
                    </div>
                </div>
                <div class="pestanaAcordeon">
                    <div class="headAcordeon">
                        <h3>Compra y venta de jugadores</h3>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="contenidoAcordeon">
                        <p>En <strong>Padel Fantasy</strong> puedes comprar y vender jugadores para formar tu equipo ideal, siempre respetando el presupuesto inicial disponible. Cada jugador tiene un valor fijo, y al venderlo, recuperas exactamente la misma cantidad por la que lo adquiriste.</p>
                        <p>Esto te permite modificar tu equipo libremente entre jornadas, sin pérdidas económicas. La estrategia está en elegir bien a quién fichar en cada momento, según su estado de forma y próximos enfrentamientos.</p>
                    </div>
                </div>
                <div class="pestanaAcordeon">
                    <div class="headAcordeon">
                        <h3>Sistema de alineación</h3>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="contenidoAcordeon">
                        <p>Cada jornada deberás alinear a tus jugadores titulares, eligiendo cuidadosamente quiénes sumarán puntos para tu equipo. <strong>Solo los jugadores alineados participarán en la puntuación de esa jornada</strong>.</p>
                        <p>El sistema te permite cambiar tu alineación entre jornadas, adaptándola al rendimiento y a los enfrentamientos del circuito. La estrategia en la elección será clave para escalar posiciones en la clasificación.</p>
                    </div>
                </div>
                <div class="pestanaAcordeon">
                    <div class="headAcordeon">
                        <h3>Sistema de puntuación</h3>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="contenidoAcordeon">
                        <h4><u>Puntuación por rendimiento en torneos oficiales</u></h4>
                        <ul>
                            <li>✅ Partido ganado: +10 puntos</li>
                            <li>❌ Partido perdido: 0 puntos</li>
                            <li>🎾 Por set ganado: +4 puntos</li>
                            <li>🥈 Llegar a cuartos de final: +5 puntos extra</li>
                            <li>🥉 Llegar a semifinales: +10 puntos extra</li>
                            <li>🥇 Llegar a la final: +15 puntos extra</li>
                            <li>🏆 Ganar el torneo: +20 puntos extra</li>
                        </ul>
                        <h4><u>Puntuación por estadísticas individuales destacadas</u></h4>
                        <ul>
                            <li>🎯 Porcentaje de primeros saques superior al 70%: +3 puntos</li>
                            <li>💪 Número de winners alto (ej. +20 en un partido): +3 puntos</li>
                            <li>🚫 Errores no forzados bajos (ej. < 10): +3 puntos</li>
                            <li>🔥 MVP del partido (según fuentes oficiales): +5 puntos</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section id="novedades">
            <h1>Lo último en tu cancha</h1>
            <div id="infoNovedades">
                <div class="novedadAppPrincipal">
                    <div class="infoNovedad">
                        <h2>¡Arranca Padel Fantasy!</h2>
                        <p>Ya está disponible el juego donde puedes crear tu propio equipo con jugadores reales del circuito profesional. Compite semana a semana, suma puntos según su rendimiento y demuestra que eres el mejor mánager. ¡No te lo pierdas!</p>
                    </div>
                    <div class="imgNovedad">
                        <img src="../assets/img/inicio_app.jpg" alt="Página de inicio de la app">
                    </div>
                </div>
                <div class="novedadAppSecundaria">
                    <div class="infoNovedad">
                        <h3>Título</h3>
                    </div>
                    <div class="imgNovedad">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="novedadAppSecundaria">
                    <div class="infoNovedad">
                        <h3>Título</h3>
                    </div>
                    <div class="imgNovedad">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="novedadAppSecundaria">
                    <div class="infoNovedad">
                        <h3>Título</h3>
                    </div>
                    <div class="imgNovedad">
                        <img src="" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section id="eventos">
            <h1>En la Red: El noticiero del Pádel</h1>
            <div id="contenidoEventos">
                <div class="noticiaPrincipal">
                    <div class="imgNoticia">
                        <img src="../assets/img/noticia_padel1.jpg" alt="">
                    </div>
                    <div class="infoNoticia">
                        <h4>Pádel - 18/05/2025</h4>
                        <h2>La Pro Padel League se internacionalizará y llegará a España en julio</h2>
                        <p>El pádel no es solo el circuito profesional. Existen otras muchas competiciones muy atractivas como la Hexagon Cup, la Reserve Cup o la Pro Padel League que ofrecen un gran espectáculo para el público y un producto diferente a lo que se puede ver habitualmente en Premier Padel. En este caso, es la Pro Padel League la que ha anunciado un giro en su filosofía, saliendo de su país de origen, Estados Unidos, para llegar también a México y España.</p>
                    </div>
                </div>
                <div class="noticiaSecundaria">
                    <div class="infoNoticia">
                        <h4>Subtítulo</h4>
                        <h2>Título</h2>
                    </div>
                    <div class="imgNoticia">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="noticiaSecundaria">
                    <div class="infoNoticia">
                        <h4>Subtítulo</h4>
                        <h2>Título</h2>
                    </div>
                    <div class="imgNoticia">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="proximosEventos">
                    <div class="proximosPartidos">
                        <h2>Próximos partidos</h2>
                        <p>Pareja 1 vs Pareja 2 | Fecha - Hora - Sede</p>
                        <p>Pareja 1 vs Pareja 2 | Fecha - Hora - Sede</p>
                        <p>Pareja 1 vs Pareja 2 | Fecha - Hora - Sede</p>
                        <p>Pareja 1 vs Pareja 2 | Fecha - Hora - Sede</p>
                        <p>Pareja 1 vs Pareja 2 | Fecha - Hora - Sede</p>
                    </div>
                    <div class="proximosTorneos">
                        <h2>Próximos torneos</h2>
                        <p>Torneo 1 | Fecha Inicio - Fecha Fin</p>
                        <p>Torneo 2 | Fecha Inicio - Fecha Fin</p>
                        <p>Torneo 3 | Fecha Inicio - Fecha Fin</p>
                        <p>Torneo 4 | Fecha Inicio - Fecha Fin</p>
                        <p>Torneo 5 | Fecha Inicio - Fecha Fin</p>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include_once "views/inc/footer.php" ?>
    <script>
        // Iniciar acordeón
        startAcordeon();
    </script>
</body>
</html>