<?php

class LoginControlador {

    public function __construct() {

    }

    public function accederLogin() {

        require_once("views/Vista.php");
        $vista = new Vista();
        $vista->renderizarVista("login");

    }

}

?>