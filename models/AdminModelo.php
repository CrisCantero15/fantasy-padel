<?php

require_once "./lib/GestorBD.php";

class AdminModelo {

    public function __construct() {
        
    }

    public function obtenerEquipos() {
        
        try {
            
            $consulta = "
                SELECT * 
                FROM `equipos`
                ORDER BY `puntuacion_total` DESC
            ";
            $resultado = GestorBD::consultaLectura($consulta);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener los equipos: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener los equipos de la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function obtenerJugadores() {
        
        try {
            
            $consulta = "
                SELECT * 
                FROM `jugadores`
                ORDER BY `en_equipo` DESC, `precio` DESC
            ";
            $resultado = GestorBD::consultaLectura($consulta);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener los jugadores: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener los jugadores de la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>