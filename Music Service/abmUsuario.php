<?php
require_once('abmLista.php');
require_once('subMenu3.php');
require_once('subMenu.php');
class Usuario{
    private $id;
    private $Nombre;
    private $Email;
    private $Contraseña;
    private $Biblioteca;
    private $Status;
    private $conexion;
    public function __construct($id, $Nombre, $Email, $Contraseña, $Status, $conexion){
     $this->id = $id;
     $this->Nombre = $Nombre;
     $this->Email = $Email;
     $this->Contraseña = $Contraseña;
     $this->Status = $Status;
     $this->conexion = $conexion;
     $this->Biblioteca = [];

     $stmt = $conexion->prepare("SELECT id, nombre FROM listas WHERE usuario_id = $this->id ");
     $stmt->execute();
     $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
     foreach($filas as $fila){
          $listaId = $fila['id'];
          $nombre = $fila['nombre'];

          $lista = new Lista($listaId, $nombre, $conexion);
          $this->Biblioteca[] = $lista;
     }
     
    }
    public function getID(){
       return $this->id;
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

    public function Guardar($newLista){
     $this->Biblioteca[] = $newLista;
    }
    public function EliminarLista($nombre){
     foreach($this->Biblioteca as $indice => $lista){
          if($lista->getLista()===$nombre){
               $id_lista = $lista->getID();
               $DL_lista = $this->conexion->prepare("DELETE FROM listas WHERE id = :id");
               $DL_lista->bindParam(':id', $id_lista, PDO::PARAM_INT);
               $DL_lista->execute();
               unset($this->Biblioteca[$indice]);
          }
     }
    }
    public function mirarLista($nombre){
    foreach($this->Biblioteca as $lista){
     if($lista->getLista() == $nombre){
          $lista->mostrarCanciones();
          write(" ");
          write("0. salir");
          write("1. agregar cancion");
          write("2. ver info de cancion");
          write("3. mofificar cancion");
          write("4. eliminar cancion");
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
               $id_lista = $lista->getID();
               write("nombre actual es: ".$lista->getLista());
               $newNombre = readline("ingrese nuevo nombre: ");
               if($newNombre != null){
               $UD_lista = $this->conexion->prepare("UPDATE listas SET nombre = :nombre WHERE id = :id");
               $UD_lista->bindParam(':nombre', $newNombre, PDO::PARAM_INT);
               $UD_lista->bindParam('id', $id_lista, PDO::PARAM_INT);
               $UD_lista->execute();
               $lista->setLista($newNombre);
               }else{
                    write("nombre invalido");
               }
          }
     }
    }

     public function combinarLista( $newLista, $lista1, $lista2) {
           
          // Verificar si las listas están en la biblioteca del usuario
               $lista1_encontrada = false;
               $lista2_encontrada = false;
               $lista1_id = null;
               $lista2_id = null;
           
               foreach ($this->Biblioteca as $lista) {
                   if ($lista->getLista() === $lista1) {
                       $lista1_encontrada = true;
                       $lista1_id = $lista->getID();
                    

                   }
                   if ($lista->getLista() === $lista2) {
                       $lista2_encontrada = true;
                       $lista2_id = $lista->getID();
                   }
                   }
           
                if ($lista1_encontrada && $lista2_encontrada){
                   
               // Insertar la nueva lista en la base de datos
               $stmtInsert = $this->conexion->prepare('INSERT INTO listas (nombre, es_publica, usuario_id) VALUES (?, false, ?)');
               $stmtInsert->execute([$newLista, $this->getID()]);
               $newListaId = $this->conexion->lastInsertId();
           
               // Recuperar las canciones de las dos listas originales
               $stmtSelectSongs = $this->conexion->prepare("SELECT * FROM canciones WHERE lista_id IN (?, ?)");
               $stmtSelectSongs->execute([$lista1_id, $lista2_id]);
               $songs = $stmtSelectSongs->fetchAll(PDO::FETCH_ASSOC);
           
               // Crear un objeto Lista para la nueva lista combinada y guardar las canciones en ella
               $newLista = new Lista($newListaId, $newLista, $this->conexion);
               foreach ($songs as $song) {
                   $cancion = new Cancion($song['id'], $song['titulo'], $song['artista'], $song['genero']);
                   $newLista->guardarCancion($cancion);
               }

               // Actualizar las canciones para que pertenezcan a la nueva lista
               $stmtUpdate = $this->conexion->prepare("UPDATE canciones SET lista_id = ? WHERE lista_id IN (?, ?)");
               $stmtUpdate->execute([$newListaId, $lista1_id, $lista2_id]);
           
               // Agregar la nueva lista combinada a la biblioteca del usuario
               $this->Biblioteca[] = $newLista;
           
               //eliminar las listas 
               $this->EliminarLista($lista1);
               $this->EliminarLista($lista2);
               
           }
          }
          
         
     

    public function MostrarLista(){


     foreach($this->Biblioteca as $lista){
          write($lista->getLista()."\n");
     }
    }
    public function EnviarList($nombre, $plataforma){
     foreach($this->Biblioteca as $lista){
          if($lista->getLista() == $nombre){
               $id = $lista->getID();
               $stmt = $this->conexion->prepare("UPDATE listas SET es_publica = true WHERE id = :id ");
               $stmt->bindParam(':id', $id, PDO::PARAM_INT);
               $stmt->execute();
               $plataforma->almacenarLista($lista);
          }
     }
    }

}









































