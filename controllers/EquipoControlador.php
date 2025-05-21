<?php

require_once "views/Vista.php";
require_once "models/EquipoModelo.php";

class EquipoControlador {

    public function __construct() {

    }

    public function accederEquipo() {
        
        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
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

    public function seleccionarJugadores() {

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            $enrutador = new Enrutador();
            $rutaApp = $enrutador->getRutaServidor();
            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Realizar una validación: solo puede haber un máximo de 4 jugadores con 'en_titular = true'. En caso de haber más, parar la acción y enviar un mensaje de alerta al usuario
            // Importante realizar la validación antes de hacer el UPDATE en la BBDD, para evitar que se actualice la información en la BBDD
            // Primero hacer un SELECT y luego un UPDATE si se puede
            // Por último, mostrar los datos en la vista según sea ($data["jugadoresEquipo"]):
                // Si se ha podido, hacer el UPDATE y mostrar normal todos los datos
                // Si no se ha podido, mostrar un mensaje de error y el array de jugadores

    }

}

?>