<?php

require_once "views/Vista.php";
require_once "models/ClasificacionModelo.php";

class ClasificacionControlador {

    public function __construct() {

    }

    public function accederClasificacion() {
        
        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
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