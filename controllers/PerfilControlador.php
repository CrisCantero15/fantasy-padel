<?php

require_once 'views/Vista.php';
require_once 'models/PerfilModelo.php';

class PerfilControlador {

    public function __construct() {

    }

    public function accederPerfil() {

        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Comprobar si el usuario es administrador para evitar accesos no autorizados desde la URL
        if ($_SESSION["usuario"] === "admin") {

            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        }

        $vista = new Vista();
        $vista->renderizarVista("perfil");

    }

    public function enviarDatos() {

        $enrutador = new Enrutador();
        $rutaApp = $enrutador->getRutaServidor();

        // Comprobar si la sesión ya está iniciada para evitar accesos no autorizados desde la URL
        if (!isset($_SESSION["usuario"])) {

            header("Location: " . $rutaApp . "login/accederLogin");
            exit();

        }

        // Comprobar si el usuario es administrador para evitar accesos no autorizados desde la URL
        if ($_SESSION["usuario"] === "admin") {

            header("Location: " . $rutaApp . "admin/accederAdmin");
            exit();

        }

        // Si existe el campo old-pass, se ejecuta el siguiente código

        if (isset($_POST["old-pass"]) && !empty($_POST["old-pass"])) {

            // +++ Verificar la contraseña con la BBDD para ver que coinciden y hacer el proceso más robusto

            $columnasConsulta = [];
            $valoresConsulta = [];
            $nombreEquipo = "";

            if (!empty(trim($_POST["nombre"]))) {

                $instanciaPerfilModelo = new PerfilModelo();
                $resultadoNombre = $instanciaPerfilModelo->validarUsuario(trim($_POST["nombre"]));

                if ($resultadoNombre) {

                    $data["errorValidacion"] = $resultadoNombre;
                    $vista = new Vista();
                    $vista->renderizarVista("perfil", $data);
                    exit();

                }

                $columnasConsulta[] = "nombre = ?";
                $valoresConsulta[] = trim($_POST["nombre"]);
                $_SESSION["usuario"] = trim($_POST["nombre"]);

            }

            if (!empty(trim($_POST["email"]))) {

                $instanciaPerfilModelo = new PerfilModelo();
                $resultadoEmail = $instanciaPerfilModelo->validarEmail(trim($_POST["email"]));

                if ($resultadoEmail) {

                    $data["errorValidacion"] = $resultadoEmail;
                    $vista = new Vista();
                    $vista->renderizarVista("perfil", $data);
                    exit();

                }

                $columnasConsulta[] = "email = ?";
                $valoresConsulta[] = trim($_POST["email"]);

            }

            if (!empty(trim($_POST["new-pass"]))) {

                $hash = password_hash(trim($_POST["new-pass"]), PASSWORD_DEFAULT);
                $columnasConsulta[] = "contrasena = ?";
                $valoresConsulta[] = $hash;

            }

            if (!empty(trim($_POST["equipo"]))) {

                $nombreEquipo = trim($_POST["equipo"]);
                $_SESSION["nombreEquipo"] = $nombreEquipo;

            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                
                $nombreOriginal = basename($_FILES["image"]["name"]);
                $nombreUnico = uniqid() . "_" . $nombreOriginal;

                $directorioDestino = "assets/img/profile/";
                $rutaCompleta = $directorioDestino . $nombreUnico;
            
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $rutaCompleta)) {
                    
                    // Guardamos solo el nombre del archivo en la BBDD
                    
                    $columnasConsulta[] = "foto_perfil = ?";
                    $valoresConsulta[] = $nombreUnico;
                    $_SESSION["foto_perfil"] = $nombreUnico;

                } else {

                    $data["errorValidacion"] = "Error al guardar la imagen. Pruebe otra vez";
                    $vista = new Vista();
                    $vista->renderizarVista("perfil", $data);
                    exit();

                }

            }

            // Llama a PerfilModelo.php y cargar las vistas correspondientes

            $instanciaPerfilModelo = new PerfilModelo();
            $resultado = $instanciaPerfilModelo->editarPerfil($columnasConsulta, $valoresConsulta, $nombreEquipo);

            if (is_array($resultado) && count($resultado) > 0) {

                $data["exitoActualizacion"] = "Perfil actualizado correctamente.";
                $vista = new Vista();
                $vista->renderizarVista("perfil", $data);

            } else {

                $data["errorValidacion"] = $resultado;
                $vista = new Vista();
                $vista->renderizarVista("perfil", $data);

            }
            
        } else {

            $data["errorValidacion"] = "El campo contraseña antigua es obligatorio.";
            $vista = new Vista();
            $vista->renderizarVista("perfil", $data);

        }

    }

}

?>