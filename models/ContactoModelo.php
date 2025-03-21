<?php

class ContactoModelo {

    public function __construct() {

    }

    public function enviarCorreo($name, $email, $mensaje) {

        // Conectar a la BBDD para guardar el mensaje en la tabla de emails

        return true; // Temporal hasta que se implemente la conexión a la BBDD
        
    }

}

?>