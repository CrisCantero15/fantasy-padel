<?php

class InicioControlador {

    public function __construct() {

    }

    public function accederInicio() {

        require_once "./lib/GestorSesion.php";
        $instanciaSesion = new GestorSesion();
        
        if (!$instanciaSesion->comprobarSesion()){

            require_once('./config/Enrutador.php');
            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }
        
        else {
            
            require_once("views/Vista.php");
            $vista = new Vista();
            $vista->renderizarVista("inicio");

        }

    }

}

?>