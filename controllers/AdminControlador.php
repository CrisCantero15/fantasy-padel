<?php

require_once "./lib/GestorSesion.php";
require_once("views/Vista.php");

Class AdminControlador {

    public function __construct() {

    }

    public function accederAdmin(){

        $instanciaSesion = new GestorSesion();

        if ($instanciaSesion->comprobarSesion()){

            $vista = new Vista();
            $vista->renderizarVista("admin");

        }

    }

    public function cerrarSesion(){

        $instanciaSesion = new GestorSesion();
        $instanciaSesion->cerrarSesion();

    }

}

?>