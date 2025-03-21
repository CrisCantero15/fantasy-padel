<?php

class ContactoControlador {

    public function __construct() {

    }

    public function accederContacto() {
        
        require_once "views/Vista.php";
        $vista = new Vista();
        $vista->renderizarVista("contacto");

    }

    public function establecerContacto() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["mensaje"]) && !empty($_POST["mensaje"])) {

                $nombre = $_POST["nombre"];
                $email = $_POST["email"];
                $mensaje = $_POST["mensaje"];

                // Guardamos el mensaje de contacto del usuario en la BBDD

                require_once "models/ContactoModelo.php";
                $modelo = new ContactoModelo(); // ¡OJO! Hay que crear el modelo de Contacto correctamente para que funcione todo con éxito
                $modelo->enviarCorreo($nombre, $email, $mensaje);

                // Insertamos la vista del contacto que muestra un mensaje de éxito al usuario

                require_once "views/Vista.php";
                $data["exitoEnvio"] = "Mensaje enviado con éxito. Gracias por contactar con nosotros, próximamente recibirás respuesta sobre tu incidencia";
                $vista = new Vista();
                $vista->renderizarVista("contacto", $data);

            } else {
                    
                    $data["errorEnvio"] = "Faltan campos por rellenar";
                    require_once "views/Vista.php";
                    $vista = new Vista();
                    $vista->renderizarVista("contacto", $data);
                
            }
    
        }
    }
}

?>