<?php

require_once "./lib/GestorSesion.php";
require_once('./config/Enrutador.php');
require_once("views/Vista.php");

class InicioControlador {

    public function __construct() {

    }

    public function accederInicio() {

        $instanciaSesion = new GestorSesion();
        
        if (!$instanciaSesion->comprobarSesion()){

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }
        
        else {
            
            $vista = new Vista();
            $vista->renderizarVista("inicio");

        }

    }

    public function cerrarSesion() {

        $instanciaSesion = new GestorSesion();
        $instanciaSesion->cerrarSesion();

    }

}

?>