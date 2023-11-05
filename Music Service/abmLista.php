<?php


class Lista{
    private $id;
    private $Nombre;
    private $Canciones;
    private $conexion;
    public function __construct($id, $Nombre, $conexion){
     $this->id = $id;
     $this->Nombre = $Nombre;
     $this->Canciones = [];
     $this->conexion = $conexion;

     $stmt = $conexion->prepare("SELECT titulo, artista, genero FROM canciones WHERE lista_id = $this->id ");
     $stmt->execute();
     $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
     foreach($filas as $fila){
        $titulo = $fila['titulo'];
        $artista = $fila['artista'];
        $genero = $fila['genero'];

        $cancion = new Cancion($titulo, $artista, $genero);
        $this->Canciones[] = $cancion;
     }
    }
    public function getID(){
        return $this->id;
    }
    public function getLista(){ 
        return $this->Nombre;
    }
    public function setLista($NewNombre){
    $this->Nombre = $NewNombre;
    }
    public function guardarCancion($cancion){
    $this->Canciones[] = $cancion;
    }
    public function verCancion($nombre){
        foreach($this-> Canciones as $cancion){
           if($cancion->getCancion() == $nombre){
             echo "\n";
             echo "nombre: ".$cancion->getCancion()."\n";
             echo "artista: ".$cancion->getArtista()."\n";
             echo "genero: ".$cancion->getGenero()."\n";
             echo "\n";
           }
        }
    }

    public function eliminarCancion($nombre){
        foreach($this->Canciones as $indice => $cancion){
            if($cancion->getCancion() === $nombre){
                unset($this->Canciones[$indice]);
            }
        }
    }
    public function modificarCancion($nombre){
      foreach($this->Canciones as $cancion){
        if($cancion->getCancion() == $nombre){
            $newArtisrta = readline("modifique el artista: ");
            $newGenero = readline("modifique el genero: ");
            if($newArtisrta != null && $newGenero != null){
                $cancion->setArtista($newArtisrta);
                $cancion->setGenero($newGenero);
            }
        }
      }
    }
    public function mostrarCanciones(){
        echo($this->Nombre."\n");
        echo("-----------------\n");
        if(empty($this->Canciones)){
            echo("lista vacia\n");
        }
        foreach ($this->Canciones as $cancion) {
           
           echo( "*".$cancion->getCancion()."\n");
           }
            
        
        }
       
        
                       
    }
 











