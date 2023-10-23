<?php

require_once('abmUsuario.php');
require_once('abmLista.php');
require_once('abmCancion.php');
require_once('Plataforma.php');
require_once('subMenu.php');
require_once('posgresql/database.php');






function registrarse($plataforma){
    write("Login");
    write("=======");
    $nombre = readline("ingrese nombre: ");
    $email = readline("ingrese email: ");
    $pasword = readline("ingrese contraseña: ");
    if($nombre != null || $email != null || $pasword != null){
        write("ingrese 2 para Beneficios Premium sino 1 para gratis");
        $opcion = readline("ingrese opcion: ");
        if($opcion == "1"){
            $newUser = new Usuario($nombre, $email, $pasword, $opcion);
            $plataforma->agregarUsuario($newUser);
            write("Bienvenido!!");
            SubMenu($newUser,$plataforma);
        }
        if($opcion == "2"){
            write("$4 dolares al mes ");
            $numero = readline("ingrese numero de tarjeta: ");
            if($numero != null){
                $PremuimUser = new Usuario($nombre, $email, $pasword, $opcion);
                $plataforma->agregarUsuario($PremuimUser);
                write("Bienvenido!!");
                SubMenu($PremuimUser,$plataforma);
            }
            else{
                write("tarjeta no valida");
            }
        }
        else{
            write("ingrese opcion valida");
        }
    }
    else{
        write("faltan datos");
    }
}
function iniciarSesion($plataforma){
$nombre = readline("ingrese su nombre de usuario: ");
$email = readline("ingrese su email: ");
$contraseña = readline("ingrese su contraseña: ");
if($nombre != null || $email != null || $contraseña != null){
    $plataforma->inicioSesion($nombre, $email, $contraseña, $plataforma);
}
else{
    write("faltan datos");
}
}
//conseguir conexion


if ($conexion) {
    echo "Conexión exitosa";
} else {
    echo "No se pudo establecer la conexión";
}

$line = null;
while($line != "0"){
    write("Bienvenido a Music Service");
    write("============================");
    write("registrese para usar nuestra app");
    write("--------------------------------");
    write("0. salir");
    write("1. Registrarse");
    write("2. iniciar sesión");
    $line = readline("ingrese opcion: ");
    if($line == "0"){
        break;
    }
    if($line == "1"){
        registrarse($musicService);
    }
    if($line == "2"){
        iniciarSesion($musicService);
    }
    else{
        write("ingrese opcion valida");
    }
}