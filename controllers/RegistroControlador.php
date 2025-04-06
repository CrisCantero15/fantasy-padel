<?php

class RegistroControlador {

    public function __construct() {

    }

    public function accederRegistro() {

        require_once("views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("registro");

    }

    public function validarRegistro() {

        // Obtener los datos del formulario y validar los campos para hacer el registor en la BBDD

    }

}

?>