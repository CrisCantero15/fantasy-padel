<?php

require_once "views/Vista.php";
require_once "models/ContactoModelo.php";

class ContactoControlador {

    public function __construct() {

    }

    public function accederContacto() {
        
        $vista = new Vista();
        $vista->renderizarVista("contacto");

    }

    public function establecerContacto() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["mensaje"]) && !empty($_POST["mensaje"]) && isset($_POST["motivo"]) && !empty($_POST["motivo"])) {

                $nombre = $_POST["nombre"];
                $email = $_POST["email"];
                $motivo = $_POST["motivo"];
                $mensaje = $_POST["mensaje"];

                // Guardamos el mensaje de contacto del usuario en la BBDD

                $modelo = new ContactoModelo(); // ¡OJO! Hay que crear el modelo de Contacto correctamente para que funcione todo con éxito
                $modelo->enviarCorreo($nombre, $email, $motivo, $mensaje);

                // Insertamos la vista del contacto que muestra un mensaje de éxito al usuario

                $data["exitoEnvio"] = "Gracias por contactar con nosotros, próximamente recibirás respuesta sobre tu incidencia";
                $vista = new Vista();
                $vista->renderizarVista("contacto", $data);

            } else {
                    
                    $data["errorEnvio"] = "Faltan campos por rellenar";
                    $vista = new Vista();
                    $vista->renderizarVista("contacto", $data);
                
            }
    
        }
    }
}

?>