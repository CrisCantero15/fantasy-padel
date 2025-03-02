<?php

class LoginControlador {

    public function __construct() {

    }

    public function accederLogin() {

        require_once("views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("login");

    }

    public function validarLogin() {
        
        if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {

            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            require_once("models/LoginModelo.php");
            $instanciaModelo = new LoginModelo();
            $usuarioValidado = $instanciaModelo->validarUsuario($usuario, $contrasena);

            if ($usuarioValidado) {

                session_start();
                $_SESSION["usuario"] = $usuario;
                require_once('./config/Enrutador.php');
                $enrutador = new Enrutador();
                $rutaApp = $enrutador->getRutaServidor();
                header("Location: " . $rutaApp . "inicio/accederInicio");

            } else {

                $data["validacionIncorrecta"] = "Usuario o contraseña incorrectos";
                require_once("views/Vista.php");
                $vista = new Vista();
                $vista->renderizarVista("login", $data);

            }

        } else {

            require_once("views/Vista.php");
            $vista = new Vista();
            $vista->renderizarVista("login", $data);

        }

    }

}

?>