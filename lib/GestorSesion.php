<?php

// Clase que se encarga de gestionar la sesión del usuario
// Iniciar la sesión, comprobar si existe una sesión activa y obtener valores de la sesión, entre otras cosas

class GestorSesion {

    public function __construct() {
        
    }

    public function iniciarSesion() {
        
        // IMPORTANTE: tener en cuenta crear una sesión que expire cada X tiempo cuando el usuario está inactivo

    }

    public function comprobarSesion() {
        
        if (isset($_SESSION["usuario"])) {
            return true;
        } else {
            return false;
        }

    }

    public function cerrarSesion() {
        
        // session_destroy();

    }

}

?>