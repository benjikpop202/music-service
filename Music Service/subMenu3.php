<?php
require_once('abmUsuario.php');
require_once('abmCancion.php');
require_once('posgresql/database.php');

//metodos para las canciones
function agregarCancion($lista){
global $conexion;
$nombre = readline("ingrese nombre de cancion: ");
$artista = readline("ingrese el nombre del artista: ");
$genero = readline("ingrese el genero: ");
if($nombre != null || $artista != null || $genero != null){
$stmt = $conexion->prepare("INSERT INTO canciones (titulo, artista, genero, lista_id) VALUES (?, ?, ?, ?) ");
$stmt->execute([$nombre, $artista, $genero, $lista->getID()]);
$cancion = new Cancion($nombre, $artista, $genero);
$lista->guardarCancion($cancion);
write("cancion agregada exitosamente");
}

}

function verCancion($lista){
    $nombre = readline("ingrese cancion: ");
    if($nombre != null){
    $lista->verCancion($nombre);
    }
    else{
        write("cancion no encontrada");
    }
}

function modificarCancion($lista){
$nombreCancion = readline("ingrese la cancion a modificar: ");
if($nombreCancion != null ){
$lista->modificarCancion($nombreCancion);
 }
else{
    write("cancion no ingresada");
}
}
function eliminarCancion($lista){
    $nombre = readline("ingrese cancion a eliminar: ");
    $artista = readline("ingrese artista de la cancion: ");
    if($nombre != null || $artista != null){
    $lista->eliminarCancion($nombre,$artista);
    }
    else{
        write("cancion no existente");
    }
}