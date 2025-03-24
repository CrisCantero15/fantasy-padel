<?php

class LoginModelo {

    public function validarUsuario($usuario, $contrasena) {

        // Conectar con la BD para validar que el usuario y la contraseña existen

        require_once "./lib/GestorBD.php";

        $consulta = "SELECT * FROM `usuarios` WHERE `nombre` = ? AND `contrasena` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $usuario, $contrasena);

        var_dump($resultado);

        return $resultado;

    }

}

?>