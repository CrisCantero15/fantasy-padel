<?php

Class AdminControlador {

    public function __construct() {

    }

    public function accederAdmin(){

        require_once "./lib/GestorSesion.php";
        $instanciaSesion = new GestorSesion();

        if ($instanciaSesion->comprobarSesion()){

            require_once("views/Vista.php");
            $vista = new Vista();
            $vista->renderizarVista("admin");

        }

    }

}

?>