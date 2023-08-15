<?php
require_once('abmUsuario.php');
require_once('abmCancion.php');

//metodos para las caniones
function agregarCancion($lista){
$nombre = readline("ingrese nombre de cancion: ");
$artista = readline("ingrese el nombre del artista: ");
$genero = readline("ingrese el genero: ");
if($nombre != null || $artista != null || $genero != null){
$cancion = new Cancion($nombre, $artista, $genero);
$lista->guardarCancion($cancion);
echo("cancion agregada exitosamente");
}

}
function modificarCancion($lista){
$nombreCancion = readline("ingrese la cancion a modificar: ");

}