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

    public function actualizarEquipo($idEquipo, $nombreEquipo, $puntuacionTotal, $presupuestoEquipo) {

        try {
            
            // 1. Validar que no existe otro equipo con el mismo nombre
            $consulta = "
                SELECT 1
                FROM `equipos`
                WHERE `nombre_equipo` = ? AND `id_equipo` != ? LIMIT 1
            ";
            $resultadoValidacion = GestorBD::consultaLectura($consulta, $nombreEquipo, $idEquipo);

            if (!empty($resultadoValidacion)) {

                return "El nombre del equipo ya existe en la base de datos. Por favor, elige otro";

            }

            // 2. Actualizar el equipo en la base de datos
            $consulta = "
                UPDATE `equipos`
                SET `nombre_equipo` = ?, `puntuacion_total` = ?, `presupuesto` = ?
                WHERE `id_equipo` = ?
            ";
            $resultadoActualizacion = GestorBD::consultaActualizacion($consulta, $nombreEquipo, $puntuacionTotal, $presupuestoEquipo, $idEquipo);

            return $resultadoActualizacion;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar el equipo: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al actualizar el equipo en la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function actualizarJugador($idJugador, $nombreJugador, $puntuacionJugador, $diferenciaPuntuacion,$precioJugador) {
        
        try {
            
            // 1. Validar que no existe otro jugador con el mismo nombre
            $consulta = "
                SELECT 1
                FROM `jugadores`
                WHERE `nombre_jugador` = ? AND `id_jugador` != ? LIMIT 1
            ";
            $resultadoValidacion = GestorBD::consultaLectura($consulta, $nombreJugador, $idJugador);
            
            if (!empty($resultadoValidacion)) {
                
                // Se obtiene un array con valores
                return [
                    'exito' => false,
                    'mensajeJugador' => "El nombre del jugador ya existe en la base de datos. Por favor, elige otro"
                ];

            }

            // 2. La diferencia entre la puntuación actual del jugador y la puntuación nueva se le añade a la puntuación total del equipo (si tiene al jugador en 'en_titular' = true)
            $consulta = "
                UPDATE `equipos`
                SET `puntuacion_total` = `puntuacion_total` + ?
                WHERE `id_equipo` = (
                    SELECT `id_equipo`
                    FROM `equipos_jugadores`
                    WHERE `id_jugador` = ? AND `en_titular` = 1
                )
            ";
            $resultadoActualizacion1 = GestorBD::consultaActualizacion($consulta, $diferenciaPuntuacion, $idJugador);
            $mensajeJugador = "";

            if ($resultadoActualizacion1 === false) {

                $mensajeJugador = "No se ha actualizado la puntuación de ningún equipo porque o el jugador no está en un equipo o porque, aunque estándolo, no es titular";

            } else {

                $mensajeJugador = "Se ha actualizado la puntuación de un equipo porque el jugador está en un equipo y es titular";

            }

            // 3. Actualizar el jugador en la tabla de jugadores
            $consulta = "
                UPDATE `jugadores`
                SET `nombre_jugador` = ?, `puntuacion_jugador` = ?, `precio` = ?
                WHERE `id_jugador` = ?
            ";
            $resultadoActualizacion2 = GestorBD::consultaActualizacion($consulta, $nombreJugador, $puntuacionJugador, $precioJugador, $idJugador);

            return [
                'exito' => $resultadoActualizacion2,
                'mensajeJugador' => $mensajeJugador
            ];

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al actualizar el jugador: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al actualizar el jugador en la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

    public function eliminarJugador($idJugador) {

        try {
            
            // 1. Eliminar el jugador de la tabla jugadores
            $consulta = "
                DELETE FROM `jugadores`
                WHERE `id_jugador` = ?
            ";
            $resultado1 = GestorBD::consultaActualizacion($consulta, $idJugador);

            // 2. Eliminar el jugador de la tabla de equipos_jugadores
            $consulta = "
                DELETE FROM `equipos_jugadores`
                WHERE `id_jugador` = ?
            ";
            $resultado2 = GestorBD::consultaActualizacion($consulta, $idJugador);

            return $resultado1 && $resultado2;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al eliminar el jugador: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al eliminar el jugador de la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>