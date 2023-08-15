<?php
require_once('abmUsuario.php');
require_once('abmLista.php');
require_once('abmCancion.php');
require_once('Plataforma.php');

//sub funciones de biblioteca
function verLista($user){
 $lista = readline("ingrese lista: ");
 $user->mirarLista($lista);
}
//
function editarLista($user){
$nombre = readline("ingrese lista a editar: ");
$user->editarLista($nombre);

}

function eliminarlista($user){
    $nombre = readline("ingrese lista a eliminar: ");
    $user->EliminarLista($nombre);
}
function enviarLista($user, $plataforma){
 if($user->getStatus() == 2){
  $nombre = readline("ingrese nombre de lista a enviar: ");
  $user->EnviarList($nombre,$plataforma);
  write("envio exitoso!!");
 }
 else{
  write("esta funcion es para usuarios Premium");
 }
}
//sub menu plataforma
function mostrarListaPlataforma($plataforma){
  $nombre = readline("ingrese el nombre de la lista: ");
  $plataforma->verLista($nombre);
}

//sub funciones de perfil
function editarUsuario($plataforma){
 $nombre = readline("ingrese su contraseña: ");
 $plataforma->editarUser($nombre);
}
function eliminarUsuario( $plataforma){
  $password = readline("ingrese su contraseña para confirmar: ");
  $plataforma->eliminarUser($password);

}

