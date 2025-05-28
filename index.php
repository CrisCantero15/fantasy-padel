<?php

session_start();
setlocale(LC_TIME, 'es_ES.UTF-8');

// Punto de partida de la App (IMPORTANTE incluir Configuracion.php que incluye las variables de configuración utilzadas en la App)
// Manejamos las diferentes rutas de acceso a la App
// Accedemos al Controlador.php-->cargarControlador para manejar las vistas a mostrar a partir de los parámetros CONTROLADOR y ACCIÓN recibidos por GET

require_once('./config/Configuracion.php');
require_once('./lib/GestorSesion.php');
require_once('./controllers/Controlador.php');

$controlador = new Controlador(); // Instanciamos el controlador
$controlador->cargarControlador(); // Cargamos el controlador

?>