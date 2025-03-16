<?php

class ContactoControlador {

    public function __construct() {

    }

    public function accederContacto() {
        
        require_once "views/Vista.php";
        $vista = new Vista();
        $vista->renderizarVista("contacto");

    }

    public function enviarCorreo() {
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST["nombre"]) && !empty($_POST["nombre"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["mensaje"]) && !empty($_POST["mensaje"])) {

                $nombre = $_POST["nombre"];
                $email = $_POST["email"];
                $mensaje = $_POST["mensaje"];

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