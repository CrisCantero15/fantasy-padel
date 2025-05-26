<?php

require_once './lib/GestorBD.php';

class MercadoModelo {

    public function __construct() {

    }

    public function obtenerJugadores() {

        try {
            
            $parametros = 0;
            $consulta = "SELECT * FROM `jugadores` WHERE `en_equipo` = ? ORDER BY `precio` DESC";
            $resultado = GestorBD::consultaLectura($consulta, $parametros);
        
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al registrar el equipo: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al registrar el equipo. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function comprarJugador($idJugador, $idEquipo, $precioJugador) {

        try {

            if (!GestorBD::iniciarTransaccion()) {

                return false;

            }
            
            // Comprobar si el jugador existe y está a la venta
            $consulta = "
                SELECT *
                FROM `jugadores`
                WHERE `id_jugador` = ?
                AND `en_equipo` = 0
            ";
            $resultadoComprobacion = GestorBD::consultaLectura($consulta, $idJugador);
            
            if (empty($resultadoComprobacion)) {

                // Si no está disponible, hacemos rollback y retornamos el mensaje
                GestorBD::cancelarTransaccion();
                return "El jugador ya no existe en el mercado. Parece que se te adelantaron";

            }

            // Iniciar la compra del jugador
            
            // 1. UPDATE en la tabla 'jugadores' para cambiar el estado del jugador a 'en_equipo'
            $consulta = "
                UPDATE `jugadores`
                SET `en_equipo` = 1
                WHERE `id_jugador` = ?
            ";
            $resultado1 = GestorBD::consultaActualizacion($consulta, $idJugador);

            // 2. INSERT en la tabla 'equipos_jugadores' para agregar el jugador al equipo
            $consulta = "
                INSERT INTO `equipos_jugadores` (`id_equipo`, `id_jugador`, `fecha_seleccion`)
                VALUES (?, ?, CURRENT_DATE)
            ";
            $resultado2 = GestorBD::consultaInsercion($consulta, $idEquipo, $idJugador);

            // 3. UPDATE en la tabla 'equipos' para actualizar el presupuesto del equipo
            $consulta = "
                UPDATE `equipos`
                SET `presupuesto` = `presupuesto` - ?
                WHERE `id_equipo` = ?
            ";
            $resultado3 = GestorBD::consultaActualizacion($consulta, $precioJugador, $idEquipo);

            if (!$resultado1 || !$resultado2 || !$resultado3) {
                
                GestorBD::cancelarTransaccion();
                return false;

            } else {

                GestorBD::confirmarTransaccion();
                return true;

            }

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al comprar el jugador: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al comprar el jugador. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>