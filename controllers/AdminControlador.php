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

    public function actualizarEquipo() {

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de configuración de la BBDD
            $configuracion = $instanciaAdminModelo->obtenerConfiguracion();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            // Obtener los datos del formulario de actualización del equipo
            if (isset($_POST["idEquipo"]) && isset($_POST["nombreEquipo"]) && isset($_POST["puntuacionTotal"]) && isset($_POST["presupuestoEquipo"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

                // Validar los datos del formulario
                $idEquipo = intval(trim($_POST["idEquipo"]));
                $nombreEquipo = trim(string: preg_replace('/\s+/', ' ', ucwords(strtolower($_POST["nombreEquipo"]))));
                $puntuacionTotal = intval(trim($_POST["puntuacionTotal"]));
                $presupuestoEquipo = intval(trim($_POST["presupuestoEquipo"]));

                if (!empty($nombreEquipo) && $puntuacionTotal >= 0 && $presupuestoEquipo >= 0) {

                    // Actualizar los datos del equipo en la BBDD
                    $resultadoActualizacion = $instanciaAdminModelo->actualizarEquipo($idEquipo, $nombreEquipo, $puntuacionTotal, $presupuestoEquipo);
                    // Obtener los datos actualizados de los equipos de la BBDD
                    $equipos = $instanciaAdminModelo->obtenerEquipos();

                    if ($resultadoActualizacion === true && is_array($equipos) && $equipos) {

                        // Si se ha actualizado correctamente el equipo, renderizar la vista de admin con los datos actualizados
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $vista->renderizarVista("admin", $data);

                    } else if ($resultadoActualizacion === false) {

                        // Si no se ha podido actualizar el equipo, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorEquipos"] = "Error al actualizar el equipo. No se realizaron cambios porque los datos introducidos son iguales a los ya existentes";
                        $vista->renderizarVista("admin", $data);

                    } else {

                        // Si se ha producido un error al actualizar el equipo, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorEquipos"] = "Error al actualizar el equipo: " . htmlspecialchars($resultadoActualizacion);
                        $vista->renderizarVista("admin", $data);

                    }
                
                } else {

                    // Si el nombre del equipo está vacío o la puntuación total o el presupuesto son menores a 0, mostrar un mensaje de error
                    $data["equipos"] = $equipos;
                    $data["jugadores"] = $jugadores;
                    $data["configuracion"] = $configuracion;
                    $data["errorEquipos"] = "Por favor, introduce un nombre de equipo válido y una puntuación total y presupuesto mayores o iguales a 0";
                    $vista->renderizarVista("admin", $data);

                }

            } else {

                // Si no se han enviado los campos necesarios, mostrar un mensaje de error
                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $data["errorEquipos"] = "Por favor, completa correctamente todos los campos del formulario";
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function actualizarJugador() {

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de configuración de la BBDD
            $configuracion = $instanciaAdminModelo->obtenerConfiguracion();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            // Obtener los datos del formulario de actualización del jugador
            if (isset($_POST["idJugador"]) && isset($_POST["nombreJugador"]) && isset($_POST["puntuacionJugador"]) && isset($_POST["precioJugador"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

                // Validar los datos del formulario
                $idJugador = intval(trim($_POST["idJugador"]));
                $nombreJugador = trim(string: preg_replace('/\s+/', ' ', ucwords(strtolower($_POST["nombreJugador"]))));
                $puntuacionJugador = intval(trim($_POST["puntuacionJugador"]));
                $precioJugador = intval(trim($_POST["precioJugador"]));

                if (!empty($nombreJugador) && $puntuacionJugador >= 0 && $precioJugador >= 0) {

                    $diferenciaPuntuacion = 0;

                    // Calcular la diferencia entre la puntuación anterior del jugador y la nueva puntuación
                    foreach($jugadores as $jugador) {
                        
                        if ($jugador["id_jugador"] === $idJugador) {
                            
                            // Restar puntuación nueva introducida y la puntuación anterior del jugador
                            $diferenciaPuntuacion = $puntuacionJugador - $jugador["puntuacion_jugador"];
                            break;

                        }

                    }

                    // Actualizar los datos del equipo en la BBDD
                    $resultadoActualizacion = $instanciaAdminModelo->actualizarJugador($idJugador, $nombreJugador, $puntuacionJugador, $diferenciaPuntuacion, $precioJugador);
                    // Obtener los datos actualizados de los equipos de la BBDD
                    $equipos = $instanciaAdminModelo->obtenerEquipos();
                    // Obtener los datos actualizados de los equipos de la BBDD
                    $jugadores = $instanciaAdminModelo->obtenerJugadores();

                    if (is_array($resultadoActualizacion) && $resultadoActualizacion["exito"] === true) {

                        // Si se ha actualizado correctamente el equipo, renderizar la vista de admin con los datos actualizados
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["mensajeJugador"] = $resultadoActualizacion["mensajeJugador"];
                        $vista->renderizarVista("admin", $data);

                    } else if ($resultadoActualizacion["exito"] === false) {

                        // Si no se ha podido actualizar el equipo, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorJugador"] = "Error al actualizar el jugador. No se realizaron cambios porque los datos introducidos son iguales a los ya existentes";
                        $vista->renderizarVista("admin", $data);

                    } else {

                        // Si se ha producido un error al actualizar el equipo, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorJugador"] = "Error al actualizar el equipo: " . htmlspecialchars($resultadoActualizacion);
                        $vista->renderizarVista("admin", $data);

                    }
                
                } else {

                    // Si el nombre del equipo está vacío o la puntuación total o el presupuesto son menores a 0, mostrar un mensaje de error
                    $data["equipos"] = $equipos;
                    $data["jugadores"] = $jugadores;
                    $data["configuracion"] = $configuracion;
                    $data["errorJugador"] = "Por favor, introduce un nombre de jugador válido y una puntuación y precio mayores o iguales a 0";
                    $vista->renderizarVista("admin", $data);

                }

            } else {

                // Si no se han enviado los campos necesarios, mostrar un mensaje de error
                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $data["errorJugador"] = "Por favor, completa correctamente todos los campos del formulario";
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

    }

    public function eliminarJugador() {

        $instanciaSesion = new GestorSesion();
        $vista = new Vista();
        $enrutador = new Enrutador();

        $rutaApp = $enrutador->getRutaServidor();

        if ($instanciaSesion->comprobarSesion() && $_SESSION["usuario"] === "admin") {

            $instanciaAdminModelo = new AdminModelo();
            // Obtener los datos de los equipos de la BBDD
            $equipos = $instanciaAdminModelo->obtenerEquipos();
            // Obtener los datos de configuración de la BBDD
            $configuracion = $instanciaAdminModelo->obtenerConfiguracion();
            // Obtener los datos de los jugadores de la BBDD
            $jugadores = $instanciaAdminModelo->obtenerJugadores();

            // Obtener los datos del formulario de actualización del jugador
            if (isset($_POST["idJugador"]) && $_SERVER["REQUEST_METHOD"] === "POST") {

                // Validar los datos del formulario
                $idJugador = intval(trim($_POST["idJugador"]));

                // Actualizar los datos del equipo en la BBDD
                $resultadoEliminacion = $instanciaAdminModelo->eliminarJugador($idJugador);
                // Obtener los datos actualizados de los equipos de la BBDD
                $jugadores = $instanciaAdminModelo->obtenerJugadores();

                    if (is_bool($resultadoEliminacion)) {

                        // Si se ha eliminado correctamente el jugador, renderizar la vista de admin con los datos actualizados
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["mensajeJugador"] = "El jugador se ha eliminado correctamente";
                        $vista->renderizarVista("admin", $data);

                    } else {

                        // Si se ha producido un error al eliminar el jugador, mostrar un mensaje de error
                        $data["equipos"] = $equipos;
                        $data["jugadores"] = $jugadores;
                        $data["configuracion"] = $configuracion;
                        $data["errorJugador"] = "Error al eliminar el jugador: " . htmlspecialchars($resultadoEliminacion);
                        $vista->renderizarVista("admin", $data);

                    }

            } else {

                // Si no se han enviado los campos necesarios, mostrar un mensaje de error
                $data["equipos"] = $equipos;
                $data["jugadores"] = $jugadores;
                $data["configuracion"] = $configuracion;
                $data["errorJugador"] = "Por favor, completa correctamente todos los campos del formulario";
                $vista->renderizarVista("admin", $data);

            }

        } else {

            header("Location: " . $rutaApp . "inicio/accederInicio");
            exit();

        }

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