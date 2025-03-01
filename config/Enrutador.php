<?php

// Clase para obtener la ruta de la URL y cargar el controlador correspondiente
// Importante acceder a la clase Configuración para obtener la URL base del servidor

class Enrutador {

    public function getRutaServidor(){

        require_once('config/Configuracion.php');
        $configuracion = Configuracion::getInstancia();
        return $configuracion->getRutaServidor();

    }

}

?>