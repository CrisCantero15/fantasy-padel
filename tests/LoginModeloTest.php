<?php

use \PHPUnit\Framework\TestCase;

class LoginModeloTest extends TestCase {
    public function testValidarUsuario()
    {

        require_once 'models/LoginModelo.php';

        $loginModelo = new LoginModelo();
        $resultado = $loginModelo->validarUsuario("admin", "admin123456");

        $this->assertEquals("admin", $resultado[0]["nombre"]);
        $this->assertIsArray($resultado);

    }
}

?>