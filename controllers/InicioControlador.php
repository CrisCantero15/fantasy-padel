<?php

class InicioControlador {

    public function __construct() {

    }

    public function accederInicio() {

        require_once("views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("inicio");

    }

}

?>