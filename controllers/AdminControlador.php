<?php

require_once "./lib/GestorSesion.php";
require_once("views/Vista.php");

Class AdminControlador {

    public function __construct() {

    }

    public function accederAdmin(){

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $vista->renderizarVista("admin");

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function actualizarPuntuacion() {

        // Paso 1: Actualizar la puntuación de un jugador
        // Paso 2: Actualizar la puntuación total del equipo que tenga ese jugador (si algun equipo lo tiene)
            // Para ello se puede hacer un SELECT SUM con un JOIN entre la tabla jugadores y equipos_jugadores con aquellos jugadores que correspondan al ID del equipo correspondiente 
            // Luego, hacer un UPDATE con el resultado de la suma de la puntuación total del equipo en la tabla equipos

    }

    public function cerrarSesion(){

        $instanciaSesion = new GestorSesion();
        $instanciaSesion->cerrarSesion();

    }

}

?>