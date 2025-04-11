<?php

require_once "views/Vista.php";

class ClasificacionControlador {

    public function __construct() {

    }

    public function accederClasificacion() {
        
        $vista = new Vista();
        $vista->renderizarVista("clasificacion");

    }

}

?>