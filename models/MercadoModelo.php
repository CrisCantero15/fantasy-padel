<?php

require_once './lib/GestorBD.php';

class MercadoModelo {

    public function __construct() {

    }

    public function obtenerJugadores() {

        try {
            
            $parametros = 0;
            $consulta = "SELECT * FROM `jugadores` WHERE `en_equipo` = ?";
            $resultado = GestorBD::consultaLectura($consulta, $parametros);
        
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al registrar el equipo: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al registrar el equipo. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>