<?php
require_once('abmLista.php');
require_once('subMenu3.php');
require_once('subMenu.php');
class Usuario{
    private $Nombre;
    private $Email;
    private $Contraseña;
    private $Biblioteca;
    private $Status;
    public function __construct($Nombre, $Email, $Contraseña, $Status){
     $this->Nombre = $Nombre;
     $this->Email = $Email;
     $this->Contraseña = $Contraseña;
     $this->Status = $Status;
     $this->Biblioteca = [];
     
    }
    public function getUsuario(){
         return $this->Nombre;
    }
    public function getEmail(){
         return $this->Email;
    }
    public function getContraseña(){
         return $this->Contraseña;
    }
    public function setContraseña($newContraseña){
        $this->Contraseña = $newContraseña;
    }
    public function getStatus(){
         return $this->Status;
    }
     public function toJson(){
         # return json_encode($this->toArray());
     }
    public function Guardar($newLista){
     $this->Biblioteca[] = $newLista;
    }
    public function EliminarLista($nombre){
     foreach($this->Biblioteca as $indice => $lista){
          if($lista->getLista()===$nombre){
               unset($this->Biblioteca[$indice]);
          }
     }
    }
    public function mirarLista($nombre){
    foreach($this->Biblioteca as $lista){
     if($lista->getLista() == $nombre){
          $lista->mostrarCanciones();
          write("0. salir");
          write("1. agregar cancion");
          write("2. modificar cancion");
          write("3. eliminar cancion");
          $opcion = readline("ingrese opion: ");
          switch ($opcion) {
               case 0: break;
               case 1: agregarCancion($lista); break;
               case 2: verCancion($lista); break;
               case 3: modificarCancion($lista); break;
               case 4: eliminarCancion($lista); break;
               default: write("opcion invalida"); break;
          } 
     }
    }
    }
    public function editarLista($nombre){
     foreach($this->Biblioteca as $lista){
          if($lista->getLista() == $nombre){
               write("nombre actual es: ".$lista->getLista());
               $newNombre = readline("ingrese nuevo nombre: ");
               $lista->setLista($newNombre);
          }
     }
    }
    public function MostrarLista(){

     foreach($this->Biblioteca as $lista){
          echo($lista->getLista()."\n");
     }
    }
    public function EnviarList($nombre, $plataforma){
     foreach($this->Biblioteca as $lista){
          if($lista->getLista() == $nombre){
               $plataforma->almacenarLista($lista);
          }
     }
    }
    

}








































