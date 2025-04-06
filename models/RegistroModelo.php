<?php

require_once './lib/GestorBD.php';

class RegistroModelo {

    public function __construct() {
        
    }

    public function registrarUsuario($username, $email, $password) {

        // Proceso de registrar el usuario en la BBDD

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $consulta = "INSERT INTO `usuarios` (`nombre`, `email`, `contrasena`) VALUES (?, ?, ?)";
        $resultado = GestorBD::consultaInsercion($consulta, $username, $email, $hash);

        return $resultado;

    }

}

?>