<?php

class RegistroControlador {

    public function __construct() {

    }

    public function accederRegistro() {

        require_once("views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("registro");

    }

}

?>