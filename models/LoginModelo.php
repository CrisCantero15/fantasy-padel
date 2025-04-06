<?php

require_once "./lib/GestorBD.php";

class LoginModelo {

    public function validarUsuario($usuario, $contrasena) {

        // Conectar con la BD para validar que el usuario y la contraseña existen

        $consulta = "SELECT * FROM `usuarios` WHERE `nombre` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $usuario);

        if ($resultado && password_verify($contrasena, $resultado[0]["contrasena"])) {
            
            return $resultado;

        } else {

            return null;

        }

    }

}

?>