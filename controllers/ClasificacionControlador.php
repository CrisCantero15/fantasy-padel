<?php

require_once "views/Vista.php";
require_once "models/ClasificacionModelo.php";

class ClasificacionControlador {

    public function __construct() {

    }

    public function accederClasificacion() {
        
        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Comprobar si el usuario es administrador para evitar accesos no autorizados desde la URL
        if ($_SESSION["usuario"] === "admin") {

            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        }

        // Obtener de la base de datos todos los datos de cada equipo para la clasificación

        $instanciaClasificacionModelo = new ClasificacionModelo();
        $equipos = $instanciaClasificacionModelo->obtenerEquipos();

        if (is_array($equipos)) {

            $data["equipos"] = $equipos;
            $vista = new Vista();
            $vista->renderizarVista("clasificacion", $data);

        } else {

            $data["errorClasificacion"] = $equipos;
            $vista = new Vista();
            $vista->renderizarVista("clasificacion", $data);

        }

    }

}

?>