<?php

// Cerebro de la App
// Se encarga de buscar la información de los modelos o a mostrar la vista correspondiente
// Recibimos los datos de CONTROLADOR y ACCIÓN mediante el método GET en la URL, lo cual define el controlador y la acción a ejecutar (ver helpers/secciones.png)

require_once("./views/Vista.php");
require_once("./controllers/InicioControlador.php");

class Controlador {

    public function cargarControlador() {
        
        // Obtenemos por GET el controlador y la acción
        // En caso de no recibir nada, cargamos el controlador por defecto (inicio)

        $controlador = "inicio";
        $accion = "";

        // Comprobamos que existe el controlador. Si existe, cargamos el controlador correspondiente. Si no existe, cargamos el inicio

        if (isset($_GET['controlador']) && !empty($_GET['controlador'])) {
            $controlador = $_GET['controlador'];
        }

        if (isset($_GET['accion']) && !empty($_GET['accion'])) {
            $accion = $_GET['accion'];
        }

        if (file_exists("./controllers/" . ucfirst($controlador) . "Controlador.php")) {
            
            require_once("./controllers/" . ucfirst($controlador) . "Controlador.php");
            $nombreControlador = ucfirst($controlador) . "Controlador";
            $instanciaControlador = new $nombreControlador();

            // Controlador + Accion

            if ($accion !== "") {

                if (method_exists($instanciaControlador, $accion)){
                
                    $instanciaControlador->$accion();
                
                // Acción no existente --> Error 404 (Error de validación)

                } else {
                    
                    $data['errorValidacion'] = 'Imposible realizar la acción solicitada';
                    $vista = new Vista();
                    $vista->renderizarVista("error404", $data);
    
                }
            
            // Al acceder a la página web por primera vez, carga InicioControlador.php desde el index.php, al no obtener parámetros GET en la ruta URL

            } else {

                $instanciaControlador->accederInicio();
                
            }

        // Si el Controlador no existe, cargamos el controlador por defecto (InicioControlador)
        
        } else {
            
            $instanciaControlador = new InicioControlador();
            $instanciaControlador->accederInicio();

        }
        
    }

}

?>