<?php
require_once('abmUsuario.php');
require_once('abmCancion.php');

//metodos para las canciones
function agregarCancion($lista){
$nombre = readline("ingrese nombre de cancion: ");
$artista = readline("ingrese el nombre del artista: ");
$genero = readline("ingrese el genero: ");
if($nombre != null || $artista != null || $genero != null){
$cancion = new Cancion($nombre, $artista, $genero);
$lista->guardarCancion($cancion);
echo("cancion agregada exitosamente");
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

}
function modificarCancion($lista){
$nombreCancion = readline("ingrese la cancion a modificar: ");
$newArtisrta = readline("modifique el artista: ");
$newGenero = readline("modifique el genero: ");
if($nombreCancion != null || $newArtisrta != null || $newGenero != null){
$lista->modificarCancion($nombreCancion,$newArtisrta, $newGenero);
 }
else{
    write("cancion no existente");
}
}
function eliminarCancion($lista){
    $nombre = readline("ingrese cancion a eliminar: ");
    $artista = readline("ingrese artista a eliminar: ");
    if($nombre != null || $artista != null){
    $lista->eliminarCancion($nombre,$artista);
    }
    else{
        write("cancion no existente");
    }
}