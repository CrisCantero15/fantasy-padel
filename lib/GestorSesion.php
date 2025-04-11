<?php

// Clase que se encarga de gestionar la sesión del usuario
// Iniciar la sesión, comprobar si existe una sesión activa y obtener valores de la sesión, entre otras cosas

require_once('./config/Enrutador.php');

class GestorSesion {

    public function __construct() {
        
    }

    public function iniciarSesion($usuarioValidado = []) {
        
        // IMPORTANTE: tener en cuenta crear una sesión que expire cada X tiempo cuando el usuario está inactivo

        // session_id(md5('FANTASYPADEL' . uniqid(mt_rand(), true)));
        session_regenerate_id(true); // Regenerar el ID de sesión para evitar ataques de fijación de sesión
        $_SESSION["id_sesion"] = session_id();
        $_SESSION["id_usuario"] = $usuarioValidado[0]["id_usuario"];
        $_SESSION["usuario"] = $usuarioValidado[0]["nombre"];
        $_SESSION["foto_perfil"] = $usuarioValidado[0]["foto_perfil"];
        $_SESSION["tiempoInicio"] = time();
        $_SESSION["ip"] = $_SERVER["REMOTE_ADDR"]; // Guardar la IP del usuario para mayor seguridad
        $_SESSION["userAgent"] = $_SERVER["HTTP_USER_AGENT"]; // Guardar el user agent del navegador para mayor seguridad

    }

    public function comprobarSesion() {

        // Mejorar la seguridad de la comprobación de los parámetros de sesión (mirar VC DAW)

        if (isset($_SESSION["usuario"])) {
            
            // Establece que la sesión esté activa hasta 60 minutos de inactividad

            $tiempo_maximo = 60 * 60; // 60 minutos de inactividad

            if ($_SESSION["ip"] !== $_SERVER["REMOTE_ADDR"] || $_SESSION["userAgent"] !== $_SERVER["HTTP_USER_AGENT"]) {
                $this->cerrarSesion();
            }

            if(time() - $_SESSION["tiempoInicio"] > $tiempo_maximo){
                $this->cerrarSesion();
            };

            $_SESSION["tiempoInicio"] = time(); // Actualizar el tiempo de inicio de sesión
            return true;

        } else {

            return false;

        }

    }

    public function cerrarSesion() {
        
        session_unset();
        session_destroy();

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();
        header("Location: " . $rutaApp . "login/accederLogin");
        exit();

    }

}

?>