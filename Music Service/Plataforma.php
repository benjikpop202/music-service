<?php

require_once('abmLista.php');

class Plataforma{
    private $nombre;
    private $usuarios;
    private $listas;
    public function __construct($nombre){
    $this->nombre = $nombre;
    $this-> usuarios = [];
    $this-> listas = [];
    }

    public function getPlataforma(){
        return $this->nombre;
    }
    public function agregarUsuario($NewUsuario){
     $this->usuarios[] = $NewUsuario;
    }
    public function eliminarUser($contraseña){
        $usuarioEliminar = false;
        foreach($this->usuarios as $indice => $usuario){
         if($usuario->getContraseña() === $contraseña){
            unset($this->usuarios[$indice]);
            $usuarioEliminar = true;
            write("gracias por utilizar music service, su cuenta ah sido eliminada");
            exit();
         }
         if(!$usuarioEliminar){
            write("contraseña incorrecta");
         }
        }
    }
    public function almacenarLista($lista){
        $this->listas[] = $lista;
    }
    public function mostrarlista(){
        echo("Listas de reproducciones \n");
        echo("--------------------------\n");
        foreach($this->listas as $lista){
          echo($lista->getLista()."\n");
            
        

    }
    }
    public function verLista($nombre){
        foreach($this->listas as $lista){
            if($lista->getLista() == $nombre){
                $lista->mostrarCanciones();
            }
        }
    }
        
    public function EditarUser($contraseña){
    foreach($this->usuarios as $user){
     if($user->getContraseña() == $contraseña){
        write("contraseña actual: ".$user->getContraseña());
        $newContraseña = readline("ingrese nueva contraseña: ");
        $user->setContraseña($newContraseña);

     }
    }

}
public function mostrarUsuarios(){
    write("Usuarios registrados");
    foreach($this->usuarios as $usuario){
        write("Nombre: ".$usuario->getUsuario());
        write("Email: ".$usuario->getEmail());
        write("Contraseña: **********");
        write("------------------------");
    }
}
public function inicioSesion($nombre,$email, $contraseña, $plataforma){
 foreach($this->usuarios as $usuario){
    if($usuario->getUsuario() == $nombre && $usuario->getEmail() == $email && $usuario->getContraseña() == $contraseña){
        write("bienvenido de vuelta");
        SubMenu($usuario,$plataforma);
    }
    else{
        write("hay datos incorrectos o no existe tal usuario");
    }
 }
}

    
   
}

$musicService = new Plataforma("music service");
$kpop = new Lista("kpop");
$musicService->almacenarLista($kpop);
$musicService->almacenarLista($EDM);
$musicService->almacenarLista($rock);








