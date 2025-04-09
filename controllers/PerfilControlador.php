<?php

require_once 'views/Vista.php';

class PerfilControlador {

    public function __construct() {

    }

    public function accederPerfil() {

        $vista = new Vista();
        $vista->renderizarVista("perfil");

    }

}

?>