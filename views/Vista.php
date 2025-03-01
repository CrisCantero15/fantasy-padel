<?php

// Renderiza la vista que recibe por parámetro desde la llamada del Controlador

class Vista {

    public function renderizarVista($vista, $datos = array()) {
        
        // Primero necesitamos saber la ruta del servidor (Enrutador)

        require_once('./config/Enrutador.php');
        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Cargamos la vista que recibe por parámetro

        if (file_exists("./views/" . $vista . ".php")) {
            
            require_once("./views/" . $vista . ".php");
            
        } else {
            
            // Si la vista no existe, cargamos la vista de error

            require_once("./views/error500.php");
        }
        
    }

}

?>