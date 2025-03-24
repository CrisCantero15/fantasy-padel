<?php

class ContactoModelo {

    public function __construct() {

    }

    public function enviarCorreo($nombre, $email, $motivo, $mensaje) {

        // Conectar a la BBDD para guardar el mensaje en la tabla de emails

        require_once './lib/GestorBD.php';

        $consulta = "INSERT INTO `contacto` (`nombre`, `email`, `motivo`, `mensaje`) VALUES (?, ?, ?, ?)";
        $resultado = GestorBD::consultaInsercion($consulta, $nombre, $email, $motivo, $mensaje);

        return $resultado; // Temporal hasta que se implemente la conexión a la BBDD
        
    }

}

?>