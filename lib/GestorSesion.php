<?php

// Clase que se encarga de gestionar la sesión del usuario
// Iniciar la sesión, comprobar si existe una sesión activa y obtener valores de la sesión, entre otras cosas

require_once('./config/Enrutador.php');

class GestorSesion {

    public function __construct() {
        
    }

    public function iniciarSesion($usuario) {
        
        // IMPORTANTE: tener en cuenta crear una sesión que expire cada X tiempo cuando el usuario está inactivo

        session_id(md5('FANTASYPADEL'));
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tiempoInicio"] = time();

    }

    public function comprobarSesion() {

        if (isset($_SESSION["usuario"])) {
            
            // Establece que la sesión esté activa hasta 60 minutos de inactividad

            $tiempo_maximo = 60 * 60; // Máximo de 60 minutos de inactividad

            if(time() - $_SESSION["tiempoInicio"] > $tiempo_maximo){

                session_unset();
                session_destroy();
                $enrutador = new Enrutador();
                $rutaApp = $enrutador->getRutaServidor();
                header("Location: " . $rutaApp . "login/accederLogin");
                exit();

            };

            $_SESSION["tiempoInicio"] = time();

            return true;

        } else {

            return false;

        }

    }

    public function cerrarSesion() {
        
        session_unset();
        session_destroy();
        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();
        header("Location: " . $rutaApp . "login/accederLogin");
        exit();

    }

}

?>