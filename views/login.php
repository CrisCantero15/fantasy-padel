<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fantasy Padel - Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="row">
        <div class="col-md-6 border-end border-2 border-primary p-3">
            <div>
                <img src="../assets/img/logo.png" alt="Logo Fantasy Padel">
            </div>
            <div>
                <form action="<?php echo $rutaApp ?>login/validarLogin" method="POST">
                    <div>
                        <label for="usuario">Usuario: </label>
                        <input type="text" id="usuario" name="usuario">
                    </div>
                    <div>
                        <label for="contrasena">Contraseña: </label>
                        <input type="password" id="contrasena" name="contrasena">
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </form>
                <p>¿No tienes una cuenta? <a href="<?php echo $rutaApp ?>registro/accederRegistro" >Regístrate</a></p>
                <p>¿Tienes algún problema? <a href="<?php echo $rutaApp ?>contacto/accederContacto" >Contáctanos</a></p> 
            </div>
        </div>
        <div class="col-md-6">
            <img src="../assets/img/portada.jpg" alt="Portada Fantasy Padel">
        </div>
    </div>
</body>
</html>