<?php

require_once './lib/GestorBD.php';

class InicioModelo {

    public function __construct() {

    }

    public function comprobarEquipo($nombreEquipo) {

        $consulta = "SELECT * FROM `equipos` WHERE `nombre_equipo` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $nombreEquipo);

        if (is_array($resultado) && count($resultado) > 0) {
            
            return false;

        } else {

            return true;

        }

    }

    public function registrarEquipo($nombreEquipo, $idUsuario) {

        try {
            
            $consulta = "INSERT INTO `equipos` (`nombre_equipo`, `id_usuario`) VALUES (?, ?)";
            $resultado = GestorBD::consultaInsercion($consulta, $nombreEquipo, $idUsuario);

            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al registrar el equipo: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al registrar el equipo. Por favor, inténtalo de nuevo más tarde.";
        
        }

    }

}

?>