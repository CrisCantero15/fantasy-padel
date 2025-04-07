<?php

use \PHPUnit\Framework\TestCase;

class RegistroModeloTest extends TestCase
{
    public function testRegistrarUsuario()
    {

        require_once 'models/RegistroModelo.php';

        $nombre = "pepito18";
        $email = "pepito18@gmail.com";
        $contrasena = "12345678";

        $registroModelo = new RegistroModelo();
        $resultado = $registroModelo->registrarUsuario($nombre, $email, $contrasena);

        $this->assertEquals(true, $resultado); // Se espera que el registro sea exitoso
        $this->assertIsBool($resultado); // Se espera que el resultado sea un booleano
       
    }
}

?>