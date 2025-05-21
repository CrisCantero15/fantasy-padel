<?php

require_once './lib/GestorBD.php';

class EquipoModelo {

    public function __construct() {
    
    }

    public function obtenerJugadores($idEquipo){

        try {
            
            $consulta = "
                SELECT `j`.`id_jugador`, `j`.`nombre_jugador`, `j`.`puntuacion_jugador`, `j`.`precio`
                FROM `jugadores` j
                JOIN `equipos_jugadores` ej ON `ej`.`id_jugador` = `j`.`id_jugador`
                WHERE `ej`.`id_equipo` = ?
                ORDER BY `j`.`puntuacion_jugador` DESC
            ";
            $resultado = GestorBD::consultaLectura($consulta, $idEquipo);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener los jugadores del equipo. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener los jugadores del equipo. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>