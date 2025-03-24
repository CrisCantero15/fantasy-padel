<?php

Class AdminControlador {

    public function __construct() {

    }

    public function accederAdmin(){

        require_once("views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("admin");

    }

}

?>