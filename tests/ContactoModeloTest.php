<?php

use \PHPUnit\Framework\TestCase;

class ContactoModeloTest extends TestCase {
    public function testEnviarCorreo()
    {

        require_once 'models/ContactoModelo.php';

        $nombre = "Juan Perez";
        $email = "juanperez@correo.com";
        $motivo = "Funciona mal la página web";
        $mensaje = "Hola, la página web no carga correctamente.";

        // Testear el envío de correo desde el modelo de contacto
        // Se espera que retorne true si el correo se envía correctamente

        $contacto = new ContactoModelo();
        $this->assertTrue($contacto->enviarCorreo(
            $nombre,
            $email,
            $motivo,
            $mensaje
        ));

    }
}

?>