<?php
require_once('abmUsuario.php');
require_once('abmLista.php');
require_once('abmCancion.php');
require_once('Plataforma.php');
require_once('subMenu2.php');
require_once('main.php');
require_once('posgresql/database.php');
require_once('funcionesListas.php');

function write($texto){
    echo($texto);
    echo(PHP_EOL);
}

function crearLista($user){
   write("CREAR LISTA");
   write("============");
   write("0. salir");
   write("1. crear lista vacia");
   write("2. crear lista compuesta");
   write("3. crear lista por genero");
   $option = readline("ingrese opcion: ");
   switch($option){
    case 1: CreateVoidList($user); break;
    case 2: crearListaDeListas($user); break;
    case 3: CreateGenereList($user);break;
    default: break;
   }
}

function verBiblioteca($user, $plataforma){
 write("BIBLIOTECA");
 write("=============");
 $user->MostrarLista();
 write(" ");
 write("0. volver al menu principal");
 write("1. ver lista");
 write("2. editar lista");
 write("3. eliminar lista");
 write("4. enviar lista");
 $opcion = readline("ingrese opcion: ");
 switch ($opcion) {
    case 1: verLista($user); break;
    case 2: editarLista($user); break;
    case 3: eliminarlista($user); break;
    case 4: enviarLista($user, $plataforma); break;
    default:  break;
 }
 
}

function verPlataforma($plataforma){
 $plataforma->mostrarlista();
 write(" ");
 write("0. volver a menu principal");
 write("1. ver lista");
 $opcion = readline("ingrese opcion: ");
 if($opcion == "1"){
   mostrarListaPlataforma($plataforma);
 }

}

function verPerfil($user,$plataforma){
    write("PERFIL");
    write("=======");
    write("nombre: ".$user->getUsuario());
    write("email: ".$user->getEmail());
    write("contraseña: ".$user->getContraseña());
    write(" ");
    write("0. volver al menu principal");
    write("1. modificar contraseña");
    write("2. eliminar cuenta");
    $opcion = readline("ingrese opcion: ");
     if($opcion == 1) {
         editarUsuario($plataforma);
        }
    if($opcion == 2){
        eliminarUsuario($plataforma);
        
    }
}



function SubMenu($usuario,$plataforma){
    $linea = null;
    while($linea != "0" ){
        echo "MUSIC SERVICE\n";
        echo "==============\n";
        echo "0. salir\n";
        echo "1. crear lista\n";
        echo "2. ir a biblioteca\n";
        echo "3. ir a plataforma\n";
        echo "4. ir a perfil\n";
        $linea = readline("ingrese opcion:\n");
        echo(" \n");
        switch($linea){
            case 0: exit();
            case 1: crearLista($usuario); break;
            case 2: verBiblioteca($usuario, $plataforma); break;
            case 3: verPlataforma($plataforma); break;
            case 4: verPerfil($usuario,$plataforma); break;
            default: write("opcion no valida"); break;
        }
    }
}
