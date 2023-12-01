<?php 
require_once('./posgresql/database.php');

function CreateVoidList($user){
    global $conexion;
    write("crea tu nueva lista!!");
    write("======================");
    $lista = readline("ingrese un nombre para lista: ");
    if($lista != null){
        $stmt = $conexion->prepare('INSERT INTO listas (nombre, es_publica, usuario_id) VALUES (?, ?, ?) ');
        $stmt->execute([$lista, 'false', $user->getID()]);
        $listaID = $conexion->lastInsertId();
        $newlista = new lista($listaID,$lista, $conexion);
        $user->Guardar($newlista);
        write("lista creada");
    }
    else{
        write("vuelva a ingresar un nombre");
    }
}