<?php

require_once "./lib/GestorSesion.php";
require_once('./config/Enrutador.php');
require_once("models/InicioModelo.php");
require_once("views/Vista.php");

class InicioControlador {

    public function __construct() {

    }

    public function accederInicio() {

        $instanciaSesion = new GestorSesion();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();
        
        if (!$instanciaSesion->comprobarSesion()){

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        } else if ($_SESSION["usuario"] === "admin") {
        
            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        } else {
            
            $vista = new Vista();
            $vista->renderizarVista("inicio");

        }

    }

    public function cerrarSesion() {

        $instanciaSesion = new GestorSesion();
        $instanciaSesion->cerrarSesion();

    }

    public function registrarEquipo() {

        $instanciaSesion = new GestorSesion();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();
        
        if (!$instanciaSesion->comprobarSesion()){

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        } else if ($_SESSION["usuario"] === "admin") {
        
            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        } else {
            
            if (isset($_POST["nombreEquipo"])) {

                $nombreEquipo = $_POST["nombreEquipo"];
                $instanciaInicio = new InicioModelo();

                // Comprobar si el nombre del equipo ya existe
                $resultadoComprobacion = $instanciaInicio->comprobarEquipo($nombreEquipo);

                if ($resultadoComprobacion !== true) {

                    $data["errorValidacion"] = "El nombre del equipo ya existe. Por favor, elige otro nombre";
                    $vista = new Vista();
                    $vista->renderizarVista("inicio", $data);
                    exit();

                }

                // Registrar el equipo
                $resultadoRegistro = $instanciaInicio->registrarEquipo($nombreEquipo, $_SESSION["id_usuario"]);
                $resultadoEquipo = $instanciaInicio->obtenerEquipo($nombreEquipo);
                
                if ($resultadoRegistro) {

                    $data["exitoRegistro"] = "Como mánager de " . $nombreEquipo . ", tu primer paso debería ser ir al mercado y empezar a crear tu equipo. ¡Buena suerte!";
                    $_SESSION["idEquipo"] = $resultadoEquipo[0]["id_equipo"];
                    $_SESSION["nombreEquipo"] = $resultadoEquipo[0]["nombre_equipo"];
                    $_SESSION["presupuestoEquipo"] = $resultadoEquipo[0]["presupuesto"];
                    $vista = new Vista();
                    $vista->renderizarVista("inicio", $data);
                    exit();

                } else {

                    $data["errorValidacion"] = "Error al registrar el equipo. Por favor, inténtalo de nuevo más tarde";
                    $vista = new Vista();
                    $vista->renderizarVista("inicio", $data);
                    exit();

                }

            } else {

                $data["errorValidacion"] = "El nombre del equipo no puede estar vacío";
                $vista = new Vista();
                $vista->renderizarVista("inicio", $data);
                exit();

            }

        }

    }

}

?>