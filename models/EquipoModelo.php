<?php

require_once './lib/GestorBD.php';

class EquipoModelo {

    public function __construct() {
    
    }

    public function obtenerJugadores($idEquipo){

        try {
            
            $consulta = "
                SELECT `j`.`id_jugador`, `j`.`nombre_jugador`, `j`.`puntuacion_jugador`, `j`.`precio`, `ej`.`en_titular`
                FROM `jugadores` j
                JOIN `equipos_jugadores` ej ON `ej`.`id_jugador` = `j`.`id_jugador`
                WHERE `ej`.`id_equipo` = ?
                ORDER BY `ej`.`en_titular` DESC
            ";
            $resultado = GestorBD::consultaLectura($consulta, $idEquipo);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener los jugadores del equipo. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener los jugadores del equipo. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function comprobarEquipo($idEquipo, $idJugador) {

        try {
            
            $consulta = "
                SELECT *
                FROM `equipos_jugadores`
                WHERE `id_equipo` = ? AND `id_jugador` = ?
            ";
            $resultado = GestorBD::consultaLectura($consulta, $idEquipo, $idJugador);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener las coincidencias entre equipo y jugador. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener las coincidencias entre equipo y jugador. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function obtenerPrecio($idJugador) {

        try {
            
            $consulta = "
                SELECT `precio`
                FROM `jugadores`
                WHERE `id_jugador` = ?
            ";
            $resultado = GestorBD::consultaLectura($consulta, $idJugador);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener el precio del jugador. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener el precio del jugador. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function seleccionarTitular($idJugador){

        try {
            
            $consulta = "
                UPDATE `equipos_jugadores`
                SET `en_titular` = 1
                WHERE `id_jugador` = ?
            ";
            $resultado = GestorBD::consultaActualizacion($consulta, $idJugador);

            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar al nuevo jugador titular. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al actualizar al nuevo jugador titular. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function deseleccionarTitular($idJugador){
        
        try {

            $consulta = "
                UPDATE `equipos_jugadores`
                SET `en_titular` = 0
                WHERE `id_jugador` = ?
            ";
            $resultado = GestorBD::consultaActualizacion($consulta, $idJugador);
            
            return $resultado;
            
        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar al deseleccionar al jugador titular. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al deseleccionar al jugador titular. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function eliminarJugador($idJugador, $idEquipo, $dineroAdquirido){
        
        try {

            // 1º. Se elimina el jugador del equipo del usuario
            $consulta = "
                DELETE FROM `equipos_jugadores`
                WHERE `id_jugador` = ?
            ";
            $resultado1 = GestorBD::consultaActualizacion($consulta, $idJugador);

            // 2º. Se actualiza el campo 'en_equipo' del jugador correspondiente
            $consulta = "
                UPDATE `jugadores`
                SET `en_equipo` = 0
                WHERE `id_jugador` = ?
            ";
            $resultado2 = GestorBD::consultaActualizacion($consulta, $idJugador);

            // 3º. Se añade el dinero ganado al equipo que vende el jugador
            $consulta = "
                UPDATE `equipos`
                SET `presupuesto` = `presupuesto` + ?
                WHERE `id_equipo` = ?
            ";
            $resultado3 = GestorBD::consultaActualizacion($consulta, $dineroAdquirido, $idEquipo);

            return $resultado1 && $resultado2 && $resultado3;
            
        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar al deseleccionar al jugador titular. Error: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al deseleccionar al jugador titular. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>