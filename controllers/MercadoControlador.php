<?php

require_once "views/Vista.php";

class MercadoControlador {

    public function __construct() {

    }

    public function accederMercado() {
        
        $vista = new Vista();
        $vista->renderizarVista("mercado");

    }

}

?>