<?php

require_once "./lib/GestorSesion.php";
require_once("models/AdminModelo.php");
require_once("views/Vista.php");

Class AdminControlador {

    public function __construct() {

    }

    public function accederAdmin(){

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();

            // Obtener los datos de configuración de la BBDD
            $configuracion = $instanciaAdminModelo->obtenerConfiguracion();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            if ($configuracion && $equipos && $jugadores) {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $vista->renderizarVista("admin", $data);

            } else {

                $vista->renderizarVista("error404", ["errorValidacion" => "Error al cargar los datos de la administración. Por favor, inténtalo de nuevo más tarde"]);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function actualizarPuntuacion() {

        // Paso 1: Actualizar la puntuación de un jugador
        // Paso 2: Actualizar la puntuación total del equipo que tenga ese jugador (si algun equipo lo tiene)
            // Para ello se puede hacer un SELECT SUM con un JOIN entre la tabla jugadores y equipos_jugadores con aquellos jugadores que correspondan al ID del equipo correspondiente 
            // Luego, hacer un UPDATE con el resultado de la suma de la puntuación total del equipo en la tabla equipos

    }

    public function anadirJugador() {

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Obtener los datos de configuración de la BBDD
            $configuracion = $instanciaAdminModelo->obtenerConfiguracion();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            // Añadir un jugador al mercado
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                
                if (isset($_POST["nombreJugador"]) && isset($_POST["precioJugador"])) {

                    $nombreJugador = trim(string: preg_replace('/\s+/', ' ', ucwords(strtolower($_POST["nombreJugador"]))));
                    $precioJugador = intval(trim($_POST["precioJugador"]));

                    if (!empty($nombreJugador) && $precioJugador > 0) {

                        // Añadir el jugador a la BBDD (Mercado)
                        $resultado = $instanciaAdminModelo->anadirJugador($nombreJugador, $precioJugador);
                        // Obtener los datos actualizados de los jugadores de la BBDD
                        $jugadores = $instanciaAdminModelo->obtenerJugadores();

                        if ($resultado === true) {

                            $data["equipos"] = $equipos;
                            $data["jugadores"] = $jugadores;
                            $data["configuracion"] = $configuracion;
                            $vista->renderizarVista("admin", $data);

                        } else if ($resultado === false) {
                            
                            $data["equipos"] = $equipos;
                            $data["jugadores"] = $jugadores;
                            $data["configuracion"] = $configuracion;
                            $vista->renderizarVista("admin", $data);

                        } else {

                            $data["equipos"] = $equipos;
                            $data["jugadores"] = $jugadores;
                            $data["configuracion"] = $configuracion;
                            $data["errorMercado"] = $resultado;
                            $vista->renderizarVista("admin", $data);

                        }

                    } else {

                        // Si el nombre del jugador está vacío o el precio es menor o igual a 0, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorMercado"] = "Por favor, introduce un nombre de jugador válido y un precio mayor que 0";
                        $vista->renderizarVista("admin", $data);

                    }

                } else {
                    
                    // Si no se han enviado los campos necesarios, mostrar un mensaje de error
                    $data["equipos"] = $equipos;
                    $data["jugadores"] = $jugadores;
                    $data["configuracion"] = $configuracion;
                    $data["errorMercado"] = "Por favor, completa correctamente todos los campos del formulario";
                    $vista->renderizarVista("admin", $data);

                }

            } else {

                // Si no se ha enviado el formulario, simplemente renderizar la vista de admin con los datos de los equipos y jugadores
                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function configurarJornada() {

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Obtener los datos de configuración de la BBDD
            $configuracion = $instanciaAdminModelo->obtenerConfiguracion();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            // Añadir un jugador al mercado
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                
                if (isset($_POST["fechaJornada"])) {

                    $fechaJornada = trim($_POST["fechaJornada"]);
                    $fechaJornadaFormateada = str_replace("T", " ", $fechaJornada) . ":00";

                    if (!empty($fechaJornadaFormateada)) {

                        // Actualizar la fecha de la jornada en la BBDD
                        $resultado = $instanciaAdminModelo->actualizarFechaJornada($fechaJornadaFormateada);

                        if (is_array($resultado) && $resultado) {

                            $data["equipos"] = $equipos;
                            $data["jugadores"] = $jugadores;
                            $data["configuracion"] = $resultado;
                            $vista->renderizarVista("admin", $data);

                        } else if ($resultado === false) {

                            $data["equipos"] = $equipos;
                            $data["jugadores"] = $jugadores;
                            $data["configuracion"] = $configuracion;
                            $data["errorConfiguracion"] = "Error al actualizar la fecha de la jornada. Por favor, inténtalo de nuevo más tarde";
                            $vista->renderizarVista("admin", $data);

                        } else {

                            $data["equipos"] = $equipos;
                            $data["jugadores"] = $jugadores;
                            $data["configuracion"] = $configuracion;
                            $data["errorConfiguracion"] = $resultado;
                            $vista->renderizarVista("admin", $data);

                        }

                    } else {

                        // Si la fecha de la jornada está vacía, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorConfiguracion"] = "Por favor, introduce una fecha de jornada válida";
                        $vista->renderizarVista("admin", $data);

                    }

                } else {

                    // Si no se han enviado los campos necesarios, mostrar un mensaje de error
                    $data["equipos"] = $equipos;
                    $data["jugadores"] = $jugadores;
                    $data["configuracion"] = $configuracion;
                    $data["errorConfiguracion"] = "Por favor, completa correctamente todos los campos del formulario";
                    $vista->renderizarVista("admin", $data);

                }

            } else {

                // Si no se ha enviado el formulario, simplemente renderizar la vista de admin con los datos de los equipos y jugadores
                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function activarAlineacion() {

        // Función para cambiar el campo en la tabla 'configuracion' de 'modif_titulares' a true
        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Activar la alineación en la BBDD
            $configuracion = $instanciaAdminModelo->activarAlineacion();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            if (is_array($configuracion) && $configuracion) {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $vista->renderizarVista("admin", $data);

            } else if ($configuracion === false) {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $instanciaAdminModelo->obtenerConfiguracion();
                $data["errorConfiguracion"] = "Error al activar la alineación. Por favor, inténtalo de nuevo más tarde";
                $vista->renderizarVista("admin", $data);

            } else {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $instanciaAdminModelo->obtenerConfiguracion();
                $data["errorConfiguracion"] = "Error al activar la alineación: " . htmlspecialchars($configuracion);
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function desactivarAlineacion() {

        // Función para cambiar el campo en la tabla 'configuracion' de 'modif_titulares' a false
        // Función para cambiar el campo en la tabla 'configuracion' de 'modif_titulares' a true
        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Desactivar la alineación en la BBDD
            $configuracion = $instanciaAdminModelo->desactivarAlineacion();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            if (is_array($configuracion) && $configuracion) {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $vista->renderizarVista("admin", $data);

            } else if ($configuracion === false) {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $instanciaAdminModelo->obtenerConfiguracion();
                $data["errorConfiguracion"] = "Error al desactivar la alineación. Por favor, inténtalo de nuevo más tarde";
                $vista->renderizarVista("admin", $data);

            } else {

                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $instanciaAdminModelo->obtenerConfiguracion();
                $data["errorConfiguracion"] = "Error al desactivar la alineación: " . htmlspecialchars($configuracion);
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function cerrarSesion(){

        $instanciaSesion = new GestorSesion();
        $instanciaSesion->cerrarSesion();

    }

}

?>