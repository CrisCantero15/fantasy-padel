<?php

require_once("./views/Vista.php");
require_once("./models/RegistroModelo.php");
require_once("./lib/GestorSesion.php");
require_once("./config/Enrutador.php");

class RegistroControlador {

    public function __construct() {

    }

    public function accederRegistro() {

        // Comprobamos si ya existe una sesión iniciada para evitar accesos no autorizados desde la URL

        $instanciaGestorSesion = new GestorSesion();
        
        if ($instanciaGestorSesion->comprobarSesion()) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "inicio/accederInicio");

        }

        // Renderizamos la vista de registro

        $vista = new Vista();
        $vista->renderizarVista("registro");

    }

    public function validarRegistro() {

        // Comprobamos si ya existe una sesión iniciada para evitar accesos no autorizados desde la URL

        $instanciaGestorSesion = new GestorSesion();
        
        if ($instanciaGestorSesion->comprobarSesion()) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "inicio/accederInicio");

        }

        // Validamos los datos del formulario de registro

        if (isset($_POST["nombre"]) && !empty(trim($_POST["nombre"])) && isset($_POST["email"]) && !empty(trim($_POST["email"])) && isset($_POST["password"]) && !empty(trim($_POST["password"])) && isset($_POST["confirmarPassword"]) && !empty(trim($_POST["confirmarPassword"]))) {

            $nombre = trim($_POST["nombre"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $confirmarPassword = $_POST["confirmarPassword"];

            if ($password === $confirmarPassword) {

                $instanciaModelo = new RegistroModelo();
                $resultado = $instanciaModelo->registrarUsuario($nombre, $email, $password);

                if (is_bool($resultado) && $resultado) {
                    
                    // Si el registro es exitoso, iniciamos sesión y redirigimos al usuario a la página de inicio

                    $data["exitoRegistro"] = "Usuario registrado correctamente. ¡Estimado/a " . $nombre . ", bienvenido a Padel Fantasy!";
                    $_SESSION["usuarioRegistro"] = $nombre;
    
                } else if (is_string($resultado)) {

                    // Si el registro falla porque el usuario o email ya existen, mostramos un mensaje de error

                    $data["errorRegistro"] = $resultado;

                } else {

                    $data["errorRegistro"] = $resultado;

                }

                $vista = new Vista();
                $vista->renderizarVista("registro", $data);
            
            } else {

                $data["errorRegistro"] = "Las contraseñas no coinciden. Por favor, verifica los campos e inténtalo de nuevo.";
                $vista = new Vista();
                $vista->renderizarVista("registro", $data);

            }
            
        } else {

            $data["errorRegistro"] = "Por favor, completa correctamente todos los campos del formulario.";
            $vista = new Vista();
            $vista->renderizarVista("registro", $data);

        }

    }

    public function iniciarLogin() {

        // Comprobar si ya existe una sesión iniciada para evitar accesos no autorizados desde la URL

        $instanciaGestorSesion = new GestorSesion();
        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();
        
        if ($instanciaGestorSesion->comprobarSesion()) {

            header("Location: " . $rutaApp . "inicio/accederInicio");

        } else {

            $instanciaGestorSesion->iniciarSesion($_SESSION["usuarioRegistro"]);
            $_SESSION["usuarioRegistro"] = null; // Limpiar la variable de sesión para evitar accesos no autorizados
            header("Location: " . $rutaApp . "inicio/accederInicio");

        }

    }

}

?>