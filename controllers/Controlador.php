<?php

// Cerebro de la App
// Se encarga de buscar la información de los modelos o a mostrar la vista correspondiente
// Recibimos los datos de CONTROLADOR y ACCIÓN mediante el método GET en la URL, lo cual define el controlador y la acción a ejecutar (ver helpers/secciones.png)

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
                
                // Acción no existente

                } else {
                    
                    $data['errorValidacion'] = 'Imposible realizar la acción solicitada';
                    require_once("./views/Vista.php");
                    $vista = new Vista();
                    $vista->renderizarVista("error500", $data);
    
                }
            
            // Controlador SÍ, Acción NO

            } else {

                require_once("./views/Vista.php");
                $vista = new Vista();
                $vista->renderizarVista("inicio");
                
            }

        } else {
            
            require_once("./views/Vista.php");
            $vista = new Vista();
            $vista->renderizarVista("login");

        }
        
    }

}

?>