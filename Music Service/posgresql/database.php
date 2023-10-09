<?php
class Conexion {
    private static $instancia;
    private $conexion;

    private function __construct() {
        $host = 'silly.db.elephantsql.com (silly-01)'; // Normalmente "localhost"
        $dbname = 'Music Service';
        $user = 'smgxrufq';
        $password = 'zPVZhEyKcLsE2ycMFtTsU0d_P1WS7f6y';

        $this->conexion = pg_connect("host=$host dbname=$dbname user=$user password=$password");

        if (!$this->conexion) {
            echo "Error: No se pudo conectar a la base de datos.";
            exit;
        }
    }

    public static function obtenerInstancia() {
        if (!self::$instancia) {
            self::$instancia = new Conexion();
        }
        return self::$instancia->conexion;
    }
}

// Uso del Singleton para obtener la conexión a la base de datos
$conexion = Conexion::obtenerInstancia();

// Ahora puedes usar $conexion para realizar consultas a la base de datos


