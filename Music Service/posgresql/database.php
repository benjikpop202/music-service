<?php
class Conexion {
    private $host = 'silly.db.elephantsql.com';
    private $usuario = 'smgxrufq';
    private $contrasena = 'zPVZhEyKcLsE2ycMFtTsU0d_P1WS7f6y';
    private $base_de_datos = 'smgxrufq';
    private $conexion;
    private static $instancia;


    private function __construct() {
       
        try {
            $this->conexion = new PDO(
                "pgsql:host={$this->host};dbname={$this->base_de_datos}",
                $this->usuario,
                $this->contrasena
            );
            // Si llegamos aquí, la conexión fue exitosa
           // echo "Conexión exitosa a la base de datos.\n";
           
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public static function obtenerInstancia() {
        if (self::$instancia == null) {
            self::$instancia = new Conexion();
        }
        return self::$instancia;
    }

    public function obtenerConexion() {
        return $this->conexion;
    }
}

// Uso del Singleton para obtener la conexión a la base de datos
 global $conexion ;
 $conexion = Conexion::obtenerInstancia()->obtenerConexion();

// Ahora puedes usar $conexion para realizar consultas a la base de datos


