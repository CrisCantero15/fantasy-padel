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
                    <p>¡No te preocupes! Puedes registrarlo ahora mismo. Para ello, introduce a continuación el nombre de tu equipo</p>
                    <form action="<?php echo $rutaApp ?>inicio/registrarEquipo" method="POST">
                        <input type="text" id="nombreEquipo" name="nombreEquipo" placeholder="Nombre del equipo" required>
                        <?php
                        if (isset($data["errorValidacion"])) { ?>
                            <div class="alert-text-warning">
                                <p><?php echo $data["errorValidacion"] ?></p>
                            </div>
                        <?php } ?>
                        <button type="submit">CREAR EQUIPO</button>
                    </form>
                </div>
            </div>
        <?php } 
        if (isset($data["exitoRegistro"])) { ?>
            <div class="modal">
                <div>
                    <h1>¡Equipo registrado!</h1>
                    <p><?php echo $data["exitoRegistro"] ?></p>
                    <button class="btn-modal" onclick="window.location.href='<?php echo $rutaApp ?>mercado/accederMercado'">IR AL MERCADO</button>
                </div>
            </div>
        <?php } ?>
        <section id="instrucciones">
            <h1>TU AVENTURA EN EL PÁDEL COMIENZA AQUÍ, ¡EMPIEZA A JUGAR Y GANAR!</h1>
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
                        <p>⚠️ <strong>Importante:</strong> una vez iniciada una jornada, no podrás vender a los jugadores que tengas como titulares. Asegúrate de hacer tus ajustes antes de que comience.</p>
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
                        <p>⚠️ La fecha y hora de inicio de la próxima jornada están indicadas en la sección <strong>EQUIPO</strong>, así que asegúrate de revisar y ajustar tu alineación antes de ese momento.</p>
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
            <h1>LO ÚLTIMO EN TU CANCHA</h1>
            <div id="infoNovedades">
                <div class="novedadAppPrincipal">
                    <div class="infoNovedad">
                        <h2>¡ARRANCA PADEL FANTASY!</h2>
                        <p>Ya está disponible el juego donde puedes crear tu propio equipo con jugadores reales del circuito profesional. Compite semana a semana, suma puntos según su rendimiento y demuestra que eres el mejor mánager. ¡No te lo pierdas!</p>
                    </div>
                    <div class="imgNovedad">
                        <img src="../assets/img/inicio_app.jpg" alt="Página de inicio de la app">
                    </div>
                </div>
                <div class="novedadAppSecundaria">
                    <div class="infoNovedad">
                        <h3>CONFIGURA TU EQUIPO INICIAL</h3>
                    </div>
                    <!-- <div class="imgNovedad">
                        <img src="" alt="">
                    </div> -->
                </div>
                <div class="novedadAppSecundaria">
                    <div class="infoNovedad">
                        <h3>COMPRA Y VENDE JUGADORES</h3>
                    </div>
                    <!-- <div class="imgNovedad">
                        <img src="" alt="">
                    </div> -->
                </div>
                <div class="novedadAppSecundaria">
                    <div class="infoNovedad">
                        <h3>VISUALIZA LA CLASIFICACIÓN</h3>
                    </div>
                    <!-- <div class="imgNovedad">
                        <img src="" alt="">
                    </div> -->
                </div>
            </div>
        </section>
        <section id="eventos">
            <h1>EN LA RED: EL NOTICIERO DEL PÁDEL</h1>
            <div id="contenidoEventos">
                <div class="noticiaPrincipal">
                    <div class="imgNoticia">
                        <img src="../assets/img/noticia_padel1.jpg" alt="">
                    </div>
                    <div class="infoNoticia">
                        <h4>Pádel - 29/05/2025</h4>
                        <h2>La Pro Padel League se internacionalizará y llegará a España en julio</h2>
                        <p>El pádel no es solo el circuito profesional. Existen otras muchas competiciones muy atractivas como la Hexagon Cup, la Reserve Cup o la Pro Padel League que ofrecen un gran espectáculo para el público y un producto diferente a lo que se puede ver habitualmente en Premier Padel. En este caso, es la Pro Padel League la que ha anunciado un giro en su filosofía, saliendo de su país de origen, Estados Unidos, para llegar también a México y España.</p>
                        <p>Se trata de un campeonato que cuenta con algunas de las principales figuras de este deporte y que tuvo bastante éxito la temporada pasada. Tiene también la peculiaridad de jugarse por equipos y en un formato liga con varias jornadas que culmina con una prueba final. Formato muy atractivo que cada vez está más presente en este deporte. </p>
                        <p>Durante el 2024 tuvieron varios eventos, pero todos en territorio norteamericano. Sin embargo, han decidido apostar por la ampliación de fronteras para dar a conocer esta competición a un público mayor. El calendario publicado cuenta con cinco fechas, entre las que se encuentra San Sebastián. La PPL lleva su producto al país donde existe mayor afición al pádel en la actualidad y a una zona donde no es habitual ver este deporte a nivel profesional. </p>
                    </div>
                </div>
                <div class="noticiaSecundaria">
                    <div class="infoNoticia">
                        <h4>Pádel - 28/05/2025</h4>
                        <h2>El bendito problema de Paquito Navarro en Argentina</h2>
                        <p>En Buenos Aires se celebra uno de los eventos más emotivos del circuito de pádel, donde el ambiente y la pasión del público argentino lo convierten en una cita imperdible, a pesar de no ser un torneo Major. Paquito Navarro, reconocido jugador español, ha confesado sentirse en parte argentino debido a la cercanía con sus compañeros de esa nacionalidad, llegando incluso a adoptar parte de su acento y costumbres.</p>
                    </div>
                    <!-- <div class="imgNoticia">
                        <img src="" alt="">
                    </div> -->
                </div>
                <div class="noticiaSecundaria">
                    <div class="infoNoticia">
                        <h4>Pádel - 27/05/2025</h4>
                        <h2>Martina y Aranza agitan la coctelera y provocan caos en 1/16</h2>
                        <p>El arranque de los torneos suele ser un desafío para las parejas mejor posicionadas, ya que se enfrentan a rivales con menos presión y más ritmo de competición. Esto les ocurrió a Martita Ortega y Alejandra Alonso, quienes fueron eliminadas por Aranza Osoro y Martina Calvo, una dupla que mostró una gran compenetración y el nivel necesario para vencer a las número cinco del ranking.</p>
                    </div>
                    <!-- <div class="imgNoticia">
                        <img src="" alt="">
                    </div> -->
                </div>
                <div class="proximosEventos">
                    <div class="proximosPartidos">
                        <h2>PRÓXIMOS PARTIDOS</h2>
                        <p><span class="colorRojo"><strong>Arturo Coello / Agustín Tapia vs. Víctor Ruiz / Francisco Gil</strong></span> | 29/05 - 12:00 (hora local) - Estadio Parque Roca</p>
                        <p><span class="colorRojo"><strong>Federico Chingotto / Alejandro Galán vs. Enrique Goenaga / Luis Hernández Quesada</strong></span> | 29/05 - 14:00 (hora local) - Estadio Parque Roca</p>
                        <p><span class="colorRojo"><strong>Gemma Triay / Delfi Brea vs. Alix Collombon / Araceli Martínez</strong></span> | 29/05 - 10:00 (hora local) - Estadio Parque Roca</p>
                        <p><span class="colorRojo"><strong>Bea González / Claudia Jensen vs. Jessica Castelló / Aranza Osoro</strong></span> | 29/05 - 12:00 (hora local) - Estadio Parque Roca</p>
                        <p><span class="colorRojo"><strong>Paula Josemaría / Ariana Sánchez vs. Lucía Sainz / Patricia Llaguno</strong></span> | 29/05 - 10:00 (hora local) - Estadio Parque Roca</p>
                    </div>
                    <div class="proximosTorneos">
                        <h2>PRÓXIMOS TORNEOS</h2>
                        <p><span class="colorRojo"><strong>Premier Padel Buenos Aires P1</strong></span> | 25/05/2025 - 01/06/2025</p>
                        <p><span class="colorRojo"><strong>BNL Italy Major</strong></span> | 09/06/2025 - 15/06/2025</p>
                        <p><span class="colorRojo"><strong>Premier Padel Valladolid P2</strong></span> | 23/06/2025 - 29/06/2025</p>
                        <p><span class="colorRojo"><strong>Premier Padel Bordeaux P2</strong></span> | 30/06/2025 - 06/07/2025</p>
                        <p><span class="colorRojo"><strong>Premier Padel Málaga P1</strong></span> | 14/07/2025 - 20/07/2025</p>
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