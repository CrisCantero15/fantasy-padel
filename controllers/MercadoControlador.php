<?php

require_once "views/Vista.php";
require_once "models/MercadoModelo.php";

class MercadoControlador {

    public function __construct() {

    }

    public function accederMercado() {
        
        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Comprobar si el usuario es administrador para evitar accesos no autorizados desde la URL
        if ($_SESSION["usuario"] === "admin") {

            header("Location: " . $rutaApp . "admin/accederAdmin");
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

    public function iniciarModalMercado($mensajeModal = "") {

        $enrutador = new Enrutador();
        $vista = new Vista();
        
        $rutaApp = $enrutador->getRutaServidor();

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Comprobar si el usuario es administrador para evitar accesos no autorizados desde la URL
        if ($_SESSION["usuario"] === "admin") {

            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        }

        // Realizar la conexión a la BBDD para obtener los datos de los jugadores
        $mercadoModelo = new MercadoModelo();
        $jugadores = $mercadoModelo->obtenerJugadores();

        if (is_array($jugadores)) {

            $data["mensajeModal"] = $mensajeModal;
            $data["jugadores"] = $jugadores;
            $vista->renderizarVista("mercado", $data);

        } else {

            $data["mensajeModal"] = $mensajeModal;
            $data["errorMercado"] = $jugadores;
            $vista->renderizarVista("mercado", $data);

        }

    }

    public function comprarJugador() {

        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Comprobar si el usuario es administrador para evitar accesos no autorizados desde la URL
        if ($_SESSION["usuario"] === "admin") {

            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        }

        if (isset($_POST["idJugador"]) && isset($_POST["precioJugador"])) {
            
            // Se obtiene el id del jugador a comprar
            $idJugador = $_POST["idJugador"];
            $precioJugador = $_POST["precioJugador"];
            $idEquipo = $_SESSION["idEquipo"];

            if ($_SESSION["presupuestoEquipo"] < $precioJugador) {

                $this->iniciarModalMercado("No cuentas con el presupuesto suficiente para afrontar el traspaso");
                exit();

            }

            $instanciaMercadoModelo = new MercadoModelo();
            $resultado = $instanciaMercadoModelo->comprarJugador($idJugador, $idEquipo, $precioJugador);

            if ($resultado === true) {
                
                $_SESSION["presupuestoEquipo"] -= $precioJugador;
                $this->iniciarModalMercado("¡Traspaso realizado con éxito!");
                exit();

            } else if ($resultado === false) {

                // Se muestra un mensaje de error de que no se pudo completar correctamente la compra
                $this->iniciarModalMercado("Error al comprar el jugador. Inténtalo de nuevo");
                exit();

            } else {

                // Se muestra un mensaje de error de que el jugador ya no existe en el mercado
                $this->iniciarModalMercado($resultado);
                exit();

            }

        } else {

            $this->iniciarModalMercado("Error al comprar el jugador. Inténtalo de nuevo");
            exit();

        }

    }

}

?>