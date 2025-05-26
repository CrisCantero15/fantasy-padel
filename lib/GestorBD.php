<?php

// Clase para gestionar la conexión con la BD
// IMPORTANTE: Utilizar el Configurador para obtener las variables de configuración de la BD

class GestorBD {

    private static $conexion = null;

    // Conexión a la BD

    private static function conectarBD() {

        require_once './config/Configuracion.php';
        $instanciaConfiguracion = Configuracion::getInstancia();
        $configBD = $instanciaConfiguracion->getConfiguracionBD();

        if(self::$conexion === null) {

            self::$conexion = new mysqli($configBD[0], $configBD[1], $configBD[2], $configBD[3]);

            if (self::$conexion->connect_error) {
                die("Error al conectar a la BD: " . self::$conexion->connect_error);
            }

            self::$conexion->set_charset("utf8");

        }

        return self::$conexion;

    }

    private static function prepararConsulta($conexion, $consulta, ...$parametros) {

        $consultaPreparada = $conexion->prepare($consulta);

        if($parametros){

            $tiposParametros = '';

            forEach($parametros as $parametro){
                $tiposParametros .= is_int($parametro) ? 'i' : 's';
            }

            $consultaPreparada->bind_param($tiposParametros, ...$parametros);

        }

        return $consultaPreparada;

    }

    public static function consultaLectura($consulta, ...$parametros) {

        $conexion = self::conectarBD();
        $consultaPreparada = self::prepararConsulta($conexion, $consulta, ...$parametros);
        $consultaPreparada->execute();
        $resultado = $consultaPreparada->get_result();

        if ($resultado->num_rows > 0) {

            return $resultado->fetch_all(MYSQLI_ASSOC);

        } else return null;

    }

    public static function consultaInsercion($consulta, ...$parametros) {

        $conexion = self::conectarBD();
        $consultaPreparada = self::prepararConsulta($conexion, $consulta, ...$parametros);
        
        if ($consultaPreparada->execute()) {

            return true;

        } else return false;

    }

    public static function consultaActualizacion($consulta, ...$parametros) {

        $conexion = self::conectarBD();
        $consultaPreparada = self::prepararConsulta($conexion, $consulta, ...$parametros);
        
        if ($consultaPreparada->execute()) {

            return $consultaPreparada->affected_rows > 0;

        } else return false;

    }

    public static function iniciarTransaccion() {

        return self::conectarBD()->begin_transaction();

    }

    public static function confirmarTransaccion() {

        return self::conectarBD()->commit();

    }

    public static function cancelarTransaccion() {

        return self::conectarBD()->rollback();

    }

    public static function desconectarBD() {
        
        if (self::$conexion) {

            self::$conexion->close();
            self::$conexion = null;

        }

    }

}

?>