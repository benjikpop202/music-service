<?php

require_once('abmLista.php');
require_once('posgresql/database.php');

class Plataforma{
    private $id;
    private $nombre;
    private $usuarios;
    private $listas;
    public function __construct($id,$nombre){
    $this->id = $id;
    $this->nombre = $nombre;
    $this-> usuarios = [];
    $this-> listas = [];
    }
    public function getIdPlataforma(){
        return $this->id;
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
public function inicioSesion($nombre,$email, $contraseña, $status, $plataforma){
 global $conexion;
 $stmt = $conexion->prepare('SELECT * FROM usuarios WHERE nombre = ? AND correo = ? AND contrasena = ? AND status = ?');
 $stmt->execute([$nombre, $email, $contraseña, $status]);
 $row = $stmt->fetch(PDO::FETCH_ASSOC);
 if ($row) {
    echo 'Inicio de sesión exitoso.'."\n";
    $newUser = new Usuario($nombre, $email, $contraseña, $status);
    $this->agregarUsuario($newUser);
    SubMenu($newUser, $plataforma);
} else {
    echo 'datos incorrectos.'."\n";
}

}

    
   
}

$musicService = new Plataforma(333,"music service");









