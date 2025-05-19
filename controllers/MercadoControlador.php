<?php

require_once "views/Vista.php";
require_once "models/MercadoModelo.php";

class MercadoControlador {

    public function __construct() {

    }

    public function accederMercado() {
        
        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Realizar la conexión a la BBDD para obtener los datos de los jugadores
        $mercadoModelo = new MercadoModelo();
        $jugadores = $mercadoModelo->obtenerJugadores();

        if (is_array($jugadores)) {

            $data["jugadores"] = $jugadores;
            $vista = new Vista();
            $vista->renderizarVista("mercado", $data);

        } else {

            $data["errorMercado"] = $jugadores;
            $vista = new Vista();
            $vista->renderizarVista("mercado", $data);

        }

    }

    public function comprarJugador() {

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Añadir el jugador a la plantilla del usuario y eliminar el jugador del mercado (campo 'en_equipo' = 1)
        // Tratar el error en caso de que se intente comprar un jugador que ya no exista en la BBDD (igual otro usuario ya lo ha comprado justo antes)

    }

}

?>