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
function crearListaDeListas($lista1, $lista2) {
    // Verificar si las listas no están vacías
    if (empty($lista1->getCanciones()) || empty($lista2->getCanciones())) {
        write("Al menos una de las listas está vacía. No se pueden combinar.");
        return;
    }

    // Combinar las canciones de las dos listas en una sola
    $nuevaLista = new Lista();
    foreach ($lista1->getCanciones() as $cancion) {
        $nuevaLista->guardarCancion($cancion);
    }
    foreach ($lista2->getCanciones() as $cancion) {
        $nuevaLista->guardarCancion($cancion);
    }

    // Eliminar las listas originales
    $lista1->eliminarTodasLasCanciones();
    $lista2->eliminarTodasLasCanciones();

    write("Se han combinado las dos listas en una sola y se han eliminado las listas originales.");
    write("La nueva lista se ha creado correctamente.");

    // Mostrar la nueva lista por consola
    $nuevaLista->mostrar();
}