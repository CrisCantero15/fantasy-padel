<?php

// Clase para almacenar todas las variables que forman parte de 
// la configuración de la aplicación (ruta servidor, ruta BD, variables de configuración de la BD, etc.)
// Singleton --> Siempre que instancie la clase, me devolverá el mismo objeto

class Configuracion {

    private static $instanciaConfiguracion = null;
    private $rutaServidor = "http://localhost/fantasy-padel/";
    private $servidorBD = "localhost";
    private $usuarioBD = "root";
    private $passwordBD = "";
    private $nombreBD = "fantasy";
    // Añadir más variables de configuración

    public static function getInstancia() {
        if (self::$instanciaConfiguracion === null) {
            self::$instanciaConfiguracion = new Configuracion();
        }
        return self::$instanciaConfiguracion;
    }

    public function getRutaServidor() {
        return $this->rutaServidor;
    }

    // Añadir los métodos GET para obtener más variables de configuración (ruta BD, variables de configuración de la BD, etc.)

    public function getConfiguracionBD() {
        return [$this->servidorBD, $this->usuarioBD, $this->passwordBD, $this->nombreBD];
    }

}

?>