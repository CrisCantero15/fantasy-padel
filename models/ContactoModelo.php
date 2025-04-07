<?php

require_once './lib/GestorBD.php';

class ContactoModelo {

    public function __construct() {

    }

    public function enviarCorreo($nombre, $email, $motivo, $mensaje) {

        // Conectar a la BBDD para guardar el mensaje en la tabla de emails
        // Mejorar la recogida de errores (añadir estructura try-catch)

        $consulta = "INSERT INTO `contacto` (`nombre`, `email`, `motivo`, `mensaje`) VALUES (?, ?, ?, ?)";
        $resultado = GestorBD::consultaInsercion($consulta, $nombre, $email, $motivo, $mensaje);

        return $resultado; // Temporal hasta que se implemente la conexión a la BBDD
        
    }

}

?>