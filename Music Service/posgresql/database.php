<?php

class Conexion {

static $pDO = null; 

static public function getConexion() {
    
    if (!Conexion::$pDO) {
        Conexion::$pDO = self::nuevaConexion();
    }   
    return Conexion::$pDO;
}

static function nuevaConexion() {
    $host = 'silly.db.elephantsql.com (silly-01)'; // Normalmente "localhost"
    $dbname = 'Music Service';
    $usuario = 'smgxrufq';
    $password = 'zPVZhEyKcLsE2ycMFtTsU0d_P1WS7f6y';

    $pDO = new PDO("pg:host=$host;dbname=$dbname", $usuario, $password);

    if ($pDO) {
        echo ('Conexion exitosa'.PHP_EOL);
    } else {
        echo ('Error en Conexion'.PHP_EOL);
    }

    return $pDO;
}

/**
 * Recibe un sql de consulta y devuelve un arreglo de objetos
 */
static function query($sql) {
    $pDO = self::getConexion();
    $statement = $pDO->query($sql, PDO::FETCH_OBJ);
    $resultado = $statement->fetchAll();
    return $resultado;
}
static function exec($sql) {
    $pDO = self::getConexion();
    $statement = $pDO->exec($sql);
    
}

}

