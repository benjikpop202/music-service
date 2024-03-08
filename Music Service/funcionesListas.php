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

function CreateGenereList($user){
 global $conexion;
 write("crea tu lista generica");
 write("======================");
 $lista = readline("ingrese nombre para lista generica: ");
 $genero = readline("ingrese el genero para la lista: ");
 if($lista != null || $genero != null){
    $stmt = $conexion->prepare('INSERT INTO listas (nombre, es_publica, usuario_id) VALUES (?, ?, ?) ');
    $stmt->execute([$lista, 'false', $user->getID()]);
    $listaID = $conexion->lastInsertId();
    $newlista = new lista($listaID,$lista, $conexion);
    $user->Guardar($newlista);
    //traer las canciones de la base de datos
    $stmt2 = $conexion->prepare('SELECT id, titulo, artista, genero FROM canciones WHERE genero LIKE :genero ORDER BY RANDOM() LIMIT 10 ');
    $stmt2->bindValue(':genero', '%' . $genero . '%', PDO::PARAM_STR);
    $stmt2->execute();
    $rows = $stmt2->fetchALL(PDO::FETCH_ASSOC);
    foreach($rows as $row){
        $id = $row['id'];
        $titulo = $row['titulo'];
        $artista = $row['artista'];
        $genero = $row['genero'];

        $cancion = new Cancion($id, $titulo, $artista, $genero);
        $newlista->guardarCancion($cancion);
    }
 }
}
function crearListaDeListas($user) {
    global $conexion;
    $NewLista = readline("ingrese nombre de lista");
    if($NewLista != null){
        $lista1 = readline("ingrese primera lista de combinacion: ");
        $lista2 = readline("ingrese segunda lista de combinacion: ");
        if($lista1 != null || $lista2 != null && $lista1 != $lista2){
            $user->combinarLista($lista1, $lista2);
        }
    }else{
        write("nombre invalido o ");
    }
    // Combinar las canciones de las dos listas en una sola
   
}