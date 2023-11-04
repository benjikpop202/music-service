<?php

require_once('abmLista.php');
require_once('posgresql/database.php');

class Plataforma{
    private $nombre;
    private $conexion;
    private $usuarios;
    private $listas;
    public function __construct($nombre, $conexion){
    $this->nombre = $nombre;
    $this->conexion = $conexion;
    $this->usuarios = [];
    $this->listas = [];

    $stmt = $conexion->prepare("SELECT id, nombre, correo, contrasena, status FROM usuarios");
    $stmt->execute();

// Obtener todas las filas como un array asociativo
   $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

   foreach ($filas as $fila) {
    $id = $fila['id'];
    $nombre = $fila['nombre'];
    $correo = $fila['correo'];
    $contrasena = $fila['contrasena'];
    $status = $fila['status'];

    // Crear un objeto Usuario (asegúrate de manejar las contraseñas de forma segura, por ejemplo, usando bcrypt)
    $usuario = new Usuario($id,$nombre, $correo, $contrasena, $status, $conexion);
    $this->usuarios[] = $usuario;
}

    $stmt2 = $conexion->prepare("SELECT id, nombre FROM listas WHERE es_publica = true");
    $stmt2->execute();

    $rows = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row){
        $listaId = $row['id'];
        $nombreLista = $row['nombre'];

        $lista = new Lista($listaId, $nombreLista, $conexion);
        $this->listas[] = $lista;
    }
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
public function inicioSesion($email, $contraseña, $plataforma){

 foreach($this->usuarios as $usuario){

  if($email == $usuario->getEmail() && $contraseña == $usuario->getContraseña() ){

    echo "bienvenido de vuelta \n";
    SubMenu($usuario, $plataforma);

  }
}
}


    
   
}

$musicService = new Plataforma("music service",$conexion);









