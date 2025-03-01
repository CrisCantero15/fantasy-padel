<?php

// Renderiza la vista que recibe por parámetro desde la llamada del Controlador

class Vista {

    public function __construct() {
        
    }

    public function renderizarVista($vista, $datos = array()) {
        
        // Primero necesitamos saber la ruta del servidor (Enrutador)

        require_once('config/Enrutador.php');
        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Cargamos la vista que recibe por parámetro (IMPORTANTE COMPROBAR QUE LA VISTA EXISTE)
        
    }

}

?>