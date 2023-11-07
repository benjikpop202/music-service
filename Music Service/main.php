<?php

require_once('abmUsuario.php');
require_once('abmLista.php');
require_once('abmCancion.php');
require_once('Plataforma.php');
require_once('subMenu.php');
require_once('posgresql/database.php');


function registrarse($plataforma) {
    global $conexion;
    write("Login");
    write("=======");
    $nombre = readline("ingrese nombre: ");
    $email = readline("ingrese email: ");
    $pasword = readline("ingrese contraseña: ");

    if (validarDatos($nombre, $email, $pasword)) {
        $opcion = readline("ingrese (premium) para Beneficios Premium sino (regular) para gratis: ");
        if ($opcion == "regular") {
            registrarUsuarioRegular($conexion, $nombre, $email, $pasword, $plataforma);
        } elseif ($opcion == "premium") {
            registrarUsuarioPremium($conexion, $nombre, $email, $pasword, $plataforma);
        } else {
            write("Ingrese una opción válida");
        }
    } else {
        write("Faltan datos");
    }
}

function validarDatos($nombre, $email, $pasword) {
    return ($nombre != null || $email != null || $pasword != null);
}

function registrarUsuarioRegular($conexion, $nombre, $email, $pasword, $plataforma) {
    global $conexion;
    $stmt = $conexion->prepare('INSERT INTO usuarios(nombre, correo, contrasena, status) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nombre, $email, $pasword, 'regular']);
    $idUser = $conexion->lastInsertId();
    $newUser = new Usuario($idUser, $nombre, $email, $pasword, 'regular', $conexion);
    $plataforma->agregarUsuario($newUser);
    write("Bienvenido!!");
    SubMenu($newUser, $plataforma);
}

function registrarUsuarioPremium($conexion, $nombre, $email, $pasword, $plataforma) {
    write("$4 dolares al mes ");
    $numero = readline("ingrese numero de tarjeta: ");
    if (validarTarjeta($numero)) {
        global $conexion;
        $stmt = $conexion->prepare('INSERT INTO usuarios(nombre, correo, contrasena, status) VALUES (?, ?, ?, ?)');
        $stmt->execute([$nombre, $email, $pasword, 'premium']);
        $idPuser = $conexion->lastInsertId();
        $PremiumUser = new Usuario($idPuser, $nombre, $email, $pasword, 'premium', $conexion);
        $plataforma->agregarUsuario($PremiumUser);
        write("Bienvenido!!");
        SubMenu($PremiumUser, $plataforma);
    } else {
        write("Tarjeta no válida");
    }
}

function validarTarjeta($numero) {
    return ($numero != null);
}

function iniciarSesion($plataforma){
$email = readline("ingrese su email: ");
$contraseña = readline("ingrese su contraseña: ");
if( $email != null || $contraseña != null ){
 $plataforma->inicioSesion( $email, $contraseña, $plataforma);
}
else{
    write("faltan datos");
}
}
//conseguir conexion


if ($conexion) {
    echo "Conexión exitosa \n";
} else {
    echo "No se pudo establecer la conexión \n";
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