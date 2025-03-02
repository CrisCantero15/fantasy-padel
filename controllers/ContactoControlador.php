<?php

class ContactoControlador {

    public function __construct() {

    }

    public function accederContacto() {
        
        require_once "views/Vista.php";
        $vista = new Vista();
        $vista->renderizarVista("contacto");

    }

}

?>