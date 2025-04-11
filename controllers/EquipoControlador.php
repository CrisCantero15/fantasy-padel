<?php

require_once "views/Vista.php";

class EquipoControlador {

    public function __construct() {

    }

    public function accederEquipo() {
        
        $vista = new Vista();
        $vista->renderizarVista("equipo");

    }

}

?>