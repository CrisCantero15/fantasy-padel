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

    public function anadirJugador($nombreJugador, $precioJugador) {

        try {
            
            // 1. Validar que el jugador no exista ya en la base de datos
            $consulta = "
                SELECT *
                FROM `jugadores`
                WHERE LOWER(`nombre_jugador`) = LOWER(?)
            ";
            $resultadoValidacion = GestorBD::consultaLectura($consulta, $nombreJugador);

            if (!empty($resultadoValidacion)) {
                return "El jugador ya existe en la base de datos. Por favor, elige otro";
            }

            // 2. Insertar el nuevo jugador en la base de datos
            $consulta = "
                INSERT INTO `jugadores` (`nombre_jugador`, `precio`)
                VALUES (?, ?)
            ";
            $resultadoFinal = GestorBD::consultaInsercion($consulta, $nombreJugador, $precioJugador);

            return $resultadoFinal;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al añadir el jugador: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al añadir el jugador a la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function obtenerConfiguracion() {

        try {
            
            $consulta = "
                SELECT DATE_FORMAT(`fecha_jornada`, '%e de %M de %Y a las %H:%i') AS `fecha_jornada`, `modif_titulares`
                FROM `configuracion`
                WHERE `id` = 1
            ";
            $resultado = GestorBD::consultaLectura($consulta);

            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener los datos de configuración " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener los datos de configuración de la aplicación en la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function actualizarFechaJornada($fechaJornada) {

        try {
            
            $consulta = "
                UPDATE `configuracion`
                SET `fecha_jornada` = ?
                WHERE `id` = 1
            ";
            $resultado = GestorBD::consultaActualizacion($consulta, $fechaJornada);

            if ($resultado) {

                $consulta = "
                    SELECT DATE_FORMAT(`fecha_jornada`, '%e de %M de %Y a las %H:%i') AS `fecha_jornada`, `modif_titulares`
                    FROM `configuracion`
                    WHERE `id` = 1
                ";
                $resultado = GestorBD::consultaLectura($consulta);

                return $resultado;

            } else {

                return $resultado;

            }

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar la fecha de la jornada: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al actualizar la fecha de la jornada en la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function activarAlineacion() {

        try {

            $consulta = "
                UPDATE `configuracion`
                SET `modif_titulares` = 1
                WHERE `id` = 1
            ";
            $resultado = GestorBD::consultaActualizacion($consulta);

            if ($resultado) {

                $consulta = "
                    SELECT DATE_FORMAT(`fecha_jornada`, '%e de %M de %Y a las %H:%i') AS `fecha_jornada`, `modif_titulares`
                    FROM `configuracion`
                    WHERE `id` = 1
                ";
                $resultado = GestorBD::consultaLectura($consulta);

                return $resultado;

            } else {

                return $resultado;

            }

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar la alineación: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al actualizar la alineación en la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function desactivarAlineacion() {

        try {

            $consulta = "
                UPDATE `configuracion`
                SET `modif_titulares` = 0
                WHERE `id` = 1
            ";
            $resultado = GestorBD::consultaActualizacion($consulta);

            if ($resultado) {

                $consulta = "
                    SELECT DATE_FORMAT(`fecha_jornada`, '%e de %M de %Y a las %H:%i') AS `fecha_jornada`, `modif_titulares`
                    FROM `configuracion`
                    WHERE `id` = 1
                ";
                $resultado = GestorBD::consultaLectura($consulta);

                return $resultado;

            } else {

                return $resultado;

            }

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al desactivar la alineación: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al desactivar la alineación en la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>