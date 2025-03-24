<?php

class LoginControlador {

    public function __construct() {

    }

    public function accederLogin() {

        require_once("./views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("login");

    }

    public function validarLogin() {
        
        if (isset($_POST["usuario"]) && isset($_POST["contrasena"]) && !empty($_POST["usuario"]) && !empty($_POST["contrasena"])) {

            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            require_once("./models/LoginModelo.php");
            $instanciaModelo = new LoginModelo();
            $usuarioValidado = $instanciaModelo->validarUsuario($usuario, $contrasena);

            if ($usuarioValidado) {
                
                $_SESSION["usuario"] = $usuario; // CAMBIAR PARA iniciarSesion() de GestorSesion
                require_once('./config/Enrutador.php');
                $enrutador = new Enrutador();
                $rutaApp = $enrutador->getRutaServidor();
                
                if ($usuario === 'admin') {

                    header("Location: " . $rutaApp . "admin/accederAdmin"); //

                } else {

                    header("Location: " . $rutaApp . "inicio/accederInicio");

                }

            } else {

                $data["errorValidacion"] = "Usuario o contraseña incorrectos";
                require_once("./views/Vista.php");
                $vista = new Vista();
                $vista->renderizarVista("login", $data);

            }

        } else { 

            $data["errorValidacion"] = "Introduzca los datos correctamente";
            require_once("./views/Vista.php");
            $vista = new Vista();
            $vista->renderizarVista("login", $data);

        }

    }

}

?>