<?php

require_once "views/Vista.php";
require_once "models/EquipoModelo.php";

class EquipoControlador {

    public function __construct() {

    }

    public function accederEquipo() {
        
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

        // Obtener el listado de los jugadores del equipo
        $idEquipo = $_SESSION["idEquipo"];
        $instanciaEquipoModelo = new EquipoModelo();
        $jugadores = $instanciaEquipoModelo->obtenerJugadores($idEquipo);

        if (is_array($jugadores)) {

            $data["jugadoresEquipo"] = $jugadores;
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);

        } else {

            $data["errorJugadores"] = $jugadores;
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);

        }

    }

    public function seleccionarJugador() {

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

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            
            $data["errorJugadores"] = "ID de jugador no válido.";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

        $idJugador = (int) $_GET["id"]; // ID del jugador seleccionado para ser titular

        $instanciaEquipoModelo = new EquipoModelo();
        // Se obtiene el listado de los jugadores del equipo sin actualizar aún para el titular
        $jugadores = $instanciaEquipoModelo->obtenerJugadores($_SESSION["idEquipo"]);
        // Validación: El jugador que se desea vender no pertenece al equipo del usuario que se está vendiendo
        $existeEquipo = $instanciaEquipoModelo->comprobarEquipo($_SESSION["idEquipo"], $idJugador);

        if (!$existeEquipo) {

            $data["jugadoresEquipo"] = $jugadores;
            $data["peticionNoAutorizada"] = "El jugador seleccionado no pertenece a tu equipo";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

        $contador = 0; // Variable para contar los jugadores que son titulares en ese momento

        foreach ($jugadores as $jugador) {
            
            if ($jugador["en_titular"] == true) {
                
                $contador++;

            }

        }

        // Se validan que no se puedan agregar más de 4 jugadores titulares
        if ($contador >= 4) {
            
            // Si no se puede añadir ese jugador como titular, mostrar el mensaje de error y el listado de jugadores
            $data["jugadoresEquipo"] = $jugadores;
            $data["errorTitular"] = "No se pueden agregar más jugadores titulares";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        } else {

            // Realizar la actualización del registro en la BBDD
            $resultadoActualizacion = $instanciaEquipoModelo->seleccionarTitular($idJugador);
            // Obtener el listado de los jugadores del equipo después de la actualización para mostrarlos en la vista
            $resultadoJugadores = $instanciaEquipoModelo->obtenerJugadores($_SESSION["idEquipo"]);

            if ($resultadoActualizacion && is_bool($resultadoActualizacion)) {

                // Si se ha podido actualizar correctamente, mostrar un mensaje de éxito y el array de jugadores
                if (is_array($resultadoJugadores)) {

                    $data["jugadoresEquipo"] = $resultadoJugadores;
                    $vista = new Vista();
                    $vista->renderizarVista("equipo", $data);
                    exit();

                } else {

                    $data["errorJugadores"] = $resultadoJugadores;
                    $vista = new Vista();
                    $vista->renderizarVista("equipo", $data);

                }

            } else if (!$resultadoActualizacion && is_bool($resultadoActualizacion)) {

                if (is_array($resultadoJugadores)) {

                    $data["jugadoresEquipo"] = $resultadoJugadores;
                    $vista = new Vista();
                    $vista->renderizarVista("equipo", $data);
                    exit();

                } else {

                    $data["errorJugadores"] = $resultadoJugadores;
                    $vista = new Vista();
                    $vista->renderizarVista("equipo", $data);

                }

            } else {

                // Si da error la actualización, mostrarlo en pantalla
                $data["errorJugadores"] = $resultadoActualizacion;
                $vista = new Vista();
                $vista->renderizarVista("equipo", $data); 

            }

        }

    }

    public function quitarJugador() {

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

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            
            $data["errorJugadores"] = "ID de jugador no válido.";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

        $idJugador = (int) $_GET["id"]; // ID del jugador seleccionado para empezar en el banquillo

        $instanciaEquipoModelo = new EquipoModelo();
        // Obtener el listado de los jugadores del equipo antes de la actualización para mostrarlos en la vista
        $jugadores = $instanciaEquipoModelo->obtenerJugadores($_SESSION["idEquipo"]);
        // Validación: El jugador que se desea vender no pertenece al equipo del usuario que se está vendiendo
        $existeEquipo = $instanciaEquipoModelo->comprobarEquipo($_SESSION["idEquipo"], $idJugador);

        if (!$existeEquipo) {

            $data["jugadoresEquipo"] = $jugadores;
            $data["peticionNoAutorizada"] = "El jugador seleccionado no pertenece a tu equipo";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

        // Realizar la actualización del registro en la BBDD
        $resultadoActualizacion = $instanciaEquipoModelo->deseleccionarTitular($idJugador);
        // Obtener el listado de los jugadores del equipo después de la actualización para mostrarlos en la vista
        $resultadoJugadores = $instanciaEquipoModelo->obtenerJugadores($_SESSION["idEquipo"]);

        if ($resultadoActualizacion && is_bool($resultadoActualizacion)) {

            // Si se ha podido actualizar correctamente, mostrar un mensaje de éxito y el array de jugadores
            if (is_array($resultadoJugadores)) {

                $data["jugadoresEquipo"] = $resultadoJugadores;
                $vista = new Vista();
                $vista->renderizarVista("equipo", $data);
                exit();

            } else {

                $data["errorJugadores"] = $resultadoJugadores;
                $vista = new Vista();
                $vista->renderizarVista("equipo", $data);

            }

        } else if (!$resultadoActualizacion && is_bool($resultadoActualizacion)) {

            if (is_array($resultadoJugadores)) {

                $data["jugadoresEquipo"] = $resultadoJugadores;
                $vista = new Vista();
                $vista->renderizarVista("equipo", $data);
                exit();

            } else {

                $data["errorJugadores"] = $resultadoJugadores;
                $vista = new Vista();
                $vista->renderizarVista("equipo", $data);

            }

        } else {

            // Si da error la actualización, mostrarlo en pantalla
            $data["errorJugadores"] = $resultadoActualizacion;
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data); 

        }

    }

    public function venderJugador() {

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

        if ((!isset($_GET["id"]) || !is_numeric($_GET["id"]))) {
            
            $data["errorJugadores"] = "ID de jugador no válido.";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

        $idJugador = (int) $_GET["id"]; // ID del jugador seleccionado para ser vendido

        $instanciaEquipoModelo = new EquipoModelo();
        // Obtener el listado de los jugadores del equipo antes de la actualización para mostrarlos en la vista
        $jugadores = $instanciaEquipoModelo->obtenerJugadores($_SESSION["idEquipo"]);
        // Validación: El jugador que se desea vender no pertenece al equipo del usuario que se está vendiendo
        $existeEquipo = $instanciaEquipoModelo->comprobarEquipo($_SESSION["idEquipo"], $idJugador);

        if (!$existeEquipo) {

            $data["jugadoresEquipo"] = $jugadores;
            $data["peticionNoAutorizada"] = "El jugador seleccionado no pertenece a tu equipo";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

        // Obtener el valor de $dineroAdquirido directamente de la BBDD
        $resultadoPrecio = $instanciaEquipoModelo->obtenerPrecio($idJugador);
        $dineroAdquirido = $resultadoPrecio[0]["precio"];
        // Eliminar el jugador del equipo y además se reconfigura el presupuesto del equipo
        $resultadoEliminacion = $instanciaEquipoModelo->eliminarJugador($idJugador, $_SESSION["idEquipo"], $dineroAdquirido);
        // Obtener el listado de los jugadores del equipo después de la actualización para mostrarlos en la vista
        $jugadores = $instanciaEquipoModelo->obtenerJugadores($_SESSION["idEquipo"]);

        if ($resultadoEliminacion) {
            
            // Se actualiza la variable de sesión de dinero del usuario
            $_SESSION["presupuestoEquipo"] = $_SESSION["presupuestoEquipo"] + $dineroAdquirido;
            $data["jugadoresEquipo"] = $jugadores;
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        } else {

            // Mostrar un mensaje de error en la vista
            $data["jugadoresEquipo"] = $jugadores;
            $data["errorTitular"] = "Error al eliminar el jugador del equipo";
            $vista = new Vista();
            $vista->renderizarVista("equipo", $data);
            exit();

        }

    }

}

?>