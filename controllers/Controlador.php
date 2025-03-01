<?php

// Cerebro de la App
// Se encarga de buscar la información de los modelos o a mostrar la vista correspondiente
// Recibimos los datos de CONTROLADOR y ACCIÓN mediante el método GET en la URL, lo cual define el controlador y la acción a ejecutar (ver helpers/secciones.png)

class Controlador {

    private $controlador;
    private $accion;

    public function __construct() {
        
    }

    public function cargarControlador() {
        
        // Obtenemos por GET el controlador y la acción
        // En caso de no recibir nada, cargamos el controlador por defecto (inicio)

        $controlador = "inicio";
        $accion = "";

        // Comprobamos que existe el controlador. Si existe, cargamos el controlador correspondiente. Si no existe, cargamos el inicio
        // ucfirst --> Convierte la primera letra de la cadena a mayúsculas
        
    }

}

?>