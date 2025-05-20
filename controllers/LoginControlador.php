<?php

require_once("./views/Vista.php");
require_once("./models/LoginModelo.php");
require_once "./lib/GestorSesion.php";
require_once('./config/Enrutador.php');

class LoginControlador {

    public function __construct() {

    }

    public function accederLogin() {

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

        $vista = new Vista();
        $vista->renderizarVista("login");

    }

    public function validarLogin() {

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

        if (isset($_POST["usuario"]) && isset($_POST["contrasena"]) && !empty($_POST["usuario"]) && !empty($_POST["contrasena"])) {

            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            $instanciaModelo = new LoginModelo();
            $usuarioValidado = $instanciaModelo->validarUsuario($usuario, $contrasena);

            // Comprobar si el usuario y la contraseña son correctos
            // En caso de que el usuario y la contraseña sean correctos, iniciar sesión
            if ($usuarioValidado) {
                
                $instanciaSesion = new GestorSesion();
                $instanciaSesion->iniciarSesion($usuarioValidado);

                // Comprobar si el usuario tiene un equipo registrado
                $resultadoComprobacion = $instanciaModelo->validarEquipo($_SESSION["id_usuario"]);

                if ($resultadoComprobacion) {

                    $_SESSION["nombreEquipo"] = $resultadoComprobacion[0]["nombre_equipo"];
                    $_SESSION["presupuestoEquipo"] = $resultadoComprobacion[0]["presupuesto"];

                } else {

                    $_SESSION["nombreEquipo"] = null;
                    
                }

                $enrutador = new Enrutador();
                $rutaApp = $enrutador->getRutaServidor();
                
                // Comprobar si el usuario es admin o no
                // En caso de que el usuario sea admin, redirigir a la página de administración
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