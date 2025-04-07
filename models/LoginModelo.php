<?php

require_once "./lib/GestorBD.php";

class LoginModelo {

    public function validarUsuario($usuario, $contrasena) {

        // Mejorar la recogida de errores (añadir estructura try-catch)

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