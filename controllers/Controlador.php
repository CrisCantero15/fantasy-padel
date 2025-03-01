<?php

// Cerebro de la App
// Se encarga de buscar la información de los modelos o a mostrar la vista correspondiente
// Recibimos los datos de CONTROLADOR y ACCIÓN mediante el método GET en la URL, lo cual define el controlador y la acción a ejecutar (ver helpers/secciones.png)

class Controlador {

    private $controlador;
    private $accion;

    public function cargarControlador() {
        
        // Obtenemos por GET el controlador y la acción
        // En caso de no recibir nada, cargamos el controlador por defecto (inicio)

        $this->controlador = "inicio";
        $this->accion = "";

        // Comprobamos que existe el controlador. Si existe, cargamos el controlador correspondiente. Si no existe, cargamos el inicio

        if (isset($_GET['controlador']) && !empty($_GET['controlador'])) {
            $this->controlador = $_GET['controlador'];
        }

        if (isset($_GET['accion']) && !empty($_GET['accion'])) {
            $this->accion = $_GET['accion'];
        }

        if(file_exists("controllers/" . ucfirst($this->controlador) . ".php")) {
            
            require_once("controllers/" . ucfirst($this->controlador) . "Controlador.php");
            $nombreControlador = ucfirst($this->controlador) . "Controlador";
            $instanciaControlador = new $nombreControlador();

            if (method_exists($instanciaControlador, $accion)){
                
                $instanciaControlador->$this->accion();
                
            }

            else {

                require_once("views/Vista.php");
                $vista = new Vista();
                $vista->renderizarVista("inicio");

            }

        } else {
            
            require_once("views/Vista.php");
            $vista = new Vista();
            $vista->renderizarVista("inicio");

        }
        
    }

}

?>