<?php

require_once "./lib/GestorBD.php";

class ClasificacionModelo {


    public function __construct() {
        
    }

    public function obtenerEquipos() {

        try {

            $consulta = "
                SELECT `e`.`nombre_equipo`, `e`.`puntuacion_total`, `u`.`nombre`, `u`.`foto_perfil`
                FROM `equipos` e
                JOIN `usuarios` u ON `e`.`id_usuario` = `u`.`id_usuario`
                ORDER BY `e`.`puntuacion_total` DESC
            ";
            $resultado = GestorBD::consultaLectura($consulta);
            
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al obtener los equipos: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al obtener los equipos de la BBDD. Por favor, inténtalo de nuevo más tarde.";

        }
        

        

    }

}

?>