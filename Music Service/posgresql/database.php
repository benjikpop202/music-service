<?php
class Conexion {
    private static $pdo = null;

    private function __construct() {
        // Configuración de la base de datos
        $host = 'silly.db.elephantsql.com';
        $dbname = 'smgxrufq';
        $usuario = 'smgxrufq';
        $password = 'zPVZhEyKcLsE2ycMFtTsU0d_P1WS7f6y';

        // Intenta establecer la conexión
        try {
            Conexion::$pdo = new PDO("pgsql:host=$host;dbname=$dbname", $usuario, $password);
            Conexion::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexión exitosa" . PHP_EOL;
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage() . PHP_EOL;
        }
    }

    public static function getConexion() {
        if (!Conexion::$pdo) {
            new Conexion();
        }
        return Conexion::$pdo;
    }

    public static function query($sql) {
        $pdo = self::getConexion();
        $statement = $pdo->query($sql);
        $resultado = $statement->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public static function exec($sql) {
        $pdo = self::getConexion();
        $rowCount = $pdo->exec($sql);
        return $rowCount;
    }
}
