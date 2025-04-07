<?php

require_once("./views/Vista.php");
require_once("./models/LoginModelo.php");
require_once "./lib/GestorSesion.php";
require_once('./config/Enrutador.php');

class LoginControlador {

    public function __construct() {

    }

    public function accederLogin() {

        // Una vez hecho el botón de cerrar sesión en inicio, comprobar aquí si existe una sesión iniciada para evitar accesos no autorizados desde la URL

        $vista = new Vista();
        $vista->renderizarVista("login");

    }

    public function validarLogin() {
        
        // Una vez hecho el botón de cerrar sesión en inicio, comprobar aquí si existe una sesión iniciada para evitar accesos no autorizados desde la URL

        if (isset($_POST["usuario"]) && isset($_POST["contrasena"]) && !empty($_POST["usuario"]) && !empty($_POST["contrasena"])) {

            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            $instanciaModelo = new LoginModelo();
            $usuarioValidado = $instanciaModelo->validarUsuario($usuario, $contrasena);

            if ($usuarioValidado) {
                
                $instanciaSesion = new GestorSesion();
                $instanciaSesion->iniciarSesion($usuario);
                $enrutador = new Enrutador();
                $rutaApp = $enrutador->getRutaServidor();
                
                if ($usuario === 'admin') {

                    header("Location: " . $rutaApp . "admin/accederAdmin");

                } else {

                    header("Location: " . $rutaApp . "inicio/accederInicio");

                }

            } else {

                $data["errorValidacion"] = "Usuario o contraseña incorrectos";
                $vista = new Vista();
                $vista->renderizarVista("login", $data);

            }

        } else { 

            $data["errorValidacion"] = "Introduzca los datos correctamente";
            $vista = new Vista();
            $vista->renderizarVista("login", $data);

        }

    }

}

?>