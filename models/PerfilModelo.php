<?php

require_once "./lib/GestorBD.php";

class PerfilModelo {

    public function __construct() {
        
    }

    public function editarPerfil($columnasConsulta = [], $valoresConsulta = [], $nombreEquipo = "") {

        $resultadosConsulta = array();

        if (isset($nombreEquipo) && !empty($nombreEquipo)) {

            $consulta = "SELECT * FROM `equipos` WHERE `nombre_equipo` = ?";
            $resultado = GestorBD::consultaLectura($consulta, $nombreEquipo);

            if (is_array($resultado) && count($resultado) > 0) {
            
                return "El equipo ya existe. Prueba otra vez.";

            } else {

                try {
            
                    $consulta = "UPDATE `equipos` SET `nombre_equipo` = ? WHERE `id_usuario` = ?";
                    $resultado = GestorBD::consultaActualizacion($consulta, $nombreEquipo, $_SESSION["id_usuario"]);
                    $resultadosConsulta[] = "Equipo actualizado correctamente.";
        
                } catch (PDOException $error) {
                    
                    echo "<script>console.error('Error al registrar el usuario: " . addslashes($error->getMessage()) . "');</script>";
                    return "Error al registrar el usuario. Por favor, inténtalo de nuevo más tarde.";
        
                }

            }

        }

        if ($valoresConsulta) {

            $valoresConsulta[] = $_SESSION["id_usuario"];

            try {

                $consulta = "UPDATE `usuarios` SET " . implode(", ", $columnasConsulta) . " WHERE `id_usuario` = ?";
                $resultado = GestorBD::consultaActualizacion($consulta, ...$valoresConsulta);
                $resultadosConsulta[] = "Perfil actualizado correctamente.";

            } catch (PDOException $error) {

                echo "<script>console.error('Error al registrar el usuario: " . addslashes($error->getMessage()) . "');</script>";
                return "Error al registrar el usuario. Por favor, inténtalo de nuevo más tarde.";

            }

        }

        return $resultadosConsulta;

        // Hacer el UPDATE con la consulta a la BBDD para actualizar el perfil del usuario

    }

    public function validarUsuario($usuario) {

        $consulta = "SELECT * FROM `usuarios` WHERE `nombre` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $usuario);

        if (is_array($resultado) && count($resultado) > 0) {
            
            return "El nombre ya existe. Prueba otra vez."; // El usuario ya existe

        }

    }

    public function validarEmail($email) {

        $consulta = "SELECT * FROM `usuarios` WHERE `email` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $email);

        if (is_array($resultado) && count($resultado) > 0) {
            
            return "El email ya existe. Prueba otra vez."; // El email ya existe

        }

    }

    public function validarContrasena($idUsuario, $contrasena) {

        $consulta = "SELECT * FROM `usuarios` WHERE `id_usuario` = ?";
        $resultado = GestorBD::consultaLectura($consulta, $idUsuario);

        return is_array($resultado) && count($resultado) > 0 && password_verify($contrasena, $resultado[0]["contrasena"]);; // El usuario y la contraseña son correctos

    }

}

?>