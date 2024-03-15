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
 if($user->getStatus()=="premium"){
    write("crea tu lista generica");
    write("======================");
    $lista = readline("ingrese nombre para lista generica: ");
    $genero = readline("ingrese el genero para la lista: ");
    $N = readline("ingrese numero de canciones(max:15): ");
    if($lista != null && $genero != null && $N != null && $N <= 15 && $N >= 1){
       //traer las canciones de la base de datos
       $stmt2 = $conexion->prepare("SELECT c.id, c.titulo, c.artista, c.genero FROM canciones c JOIN listas l ON c.lista_id = l.id WHERE l.es_publica = true AND c.genero LIKE :genero ORDER BY RANDOM() LIMIT $N ");
       $stmt2->bindValue(':genero', '%' . $genero . '%', PDO::PARAM_STR);
       $stmt2->execute();
       $numFilas = $stmt2->rowCount();
       if($numFilas === 0 || $numFilas != $N){
        write("genero no encontrado o cantidad insuficiente");
       }else{
        $stmt = $conexion->prepare('INSERT INTO listas (nombre, es_publica, usuario_id) VALUES (?, ?, ?) ');
        $stmt->execute([$lista, 'false', $user->getID()]);
        $listaID = $conexion->lastInsertId();
        $newlista = new lista($listaID,$lista, $conexion);
        $user->Guardar($newlista);
        $rows = $stmt2->fetchALL(PDO::FETCH_ASSOC);
       foreach($rows as $row){
           $titulo = $row['titulo'];
           $artista = $row['artista'];
           $genero = $row['genero'];
           //crear copias de canciones
           $stmt3 = $conexion->prepare('INSERT INTO canciones (titulo, artista, genero, lista_id) VALUES (?, ?, ?, ?) ');
           $stmt3->execute([$titulo, $artista, $genero, $newlista->getID()]);
       }
       $newCancion = $conexion->prepare("SELECT c.id, c.titulo, c.artista, c.genero FROM canciones c WHERE c.lista_id = :id");
       $newCancion->bindValue(':id', $newlista->getID());
       $newCancion->execute();
       $filas = $newCancion->fetchALL(PDO::FETCH_ASSOC);
       foreach($filas as $fila){
        $id = $fila['id'];
        $titulo = $fila['titulo'];
        $artista = $fila['artista'];
        $genero = $fila['genero'];
        $cancion = new Cancion($id, $titulo, $artista, $genero);
        $newlista->guardarCancion($cancion);
    }
    write("lista creada");
       }
       
    }else{
        write("campos vacios o nro de canciones invalidas");
    }
 }else{
    write("opcion premium");
 }
 
 }
function crearListaDeListas($user) {
    $NewLista = readline("ingrese nombre de lista: ");
    if($NewLista != null){
        $lista1 = readline("ingrese primera lista de combinacion: ");
        $lista2 = readline("ingrese segunda lista de combinacion: ");
        if($lista1 != null || $lista2 != null || $lista1 != $lista2){
            $user->combinarLista($NewLista, $lista1, $lista2);
        }
    }else{
        write("nombre invalido o ");
    }
    // Combinar las canciones de las dos listas en una sola
   
}