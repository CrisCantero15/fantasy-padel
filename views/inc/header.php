<header>
    <div id="logo">
        <a href="<?php echo $rutaApp ?>inicio/accederInicio">
            <img src="../assets/img/logo.png" alt="Logo Padel Fantasy">
        </a>
    </div>
    <div>
        <ul>
            <li class="header-list">
                <a href="<?php echo $rutaApp ?>/plantilla/accederPlantilla">
                    <i class="fa-solid fa-people-group"></i>
                    <p>PLANTILLA</p>
                </a>
            </li>
            <li class="header-list">
                <a href="<?php echo $rutaApp ?>/mercado/accederMercado">
                    <i class="fa-solid fa-store"></i>
                    <p>MERCADO</p>
                </a>
            </li>
            <li class="header-list">
                <a href="<?php echo $rutaApp ?>/clasificacion/accederClasificacion">
                    <i class="fa-solid fa-bars"></i>
                    <p>CLASIFICACIÓN</p>
                </a>
            </li>
            <li class="header-list">
                <a href="<?php echo $rutaApp ?>/perfil/accederPerfil">
                    <img src="../assets/img/perfil_estandar.jpg" alt="Imagen de perfil" style="width: 30px; height: 30px">
                    <p><?php echo strtoupper($_SESSION["usuario"]) ?></p>
                </a>
            </li>
        </ul>
    </div>
    <div>
        <button onclick="window.location.href='<?php echo $rutaApp . 'inicio/cerrarSesion'; ?>'">CERRAR SESIÓN</button>
    </div>
</header>