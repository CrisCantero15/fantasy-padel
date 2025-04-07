<?php

require_once './lib/GestorBD.php';

class RegistroModelo {

    public function __construct() {
        
    }

    public function registrarUsuario($username, $email, $password) {

        // Comprobamos si el usuario ya existe en la BBDD

        $consulta = "SELECT * FROM `usuarios` WHERE `email` = ? OR `nombre` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $email, $username);

        if (is_array($resultado) && count($resultado) > 0) {
            
            return "El usuario o email ya existen. Prueba otra vez."; // El usuario o email ya existen

        }

        // Proceso de registrar el usuario en la BBDD

        try {
            
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $consulta = "INSERT INTO `usuarios` (`nombre`, `email`, `contrasena`) VALUES (?, ?, ?)";
            $resultado = GestorBD::consultaInsercion($consulta, $username, $email, $hash);
            return $resultado;

        } catch (PDOException $error) {
            
            echo "<script>console.error('Error al registrar el usuario: " . addslashes($error->getMessage()) . "');</script>";
            return "Error al registrar el usuario. Por favor, inténtalo de nuevo más tarde.";

        }

    }

}

?>