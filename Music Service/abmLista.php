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

     $stmt = $conexion->prepare("SELECT id, titulo, artista, genero FROM canciones WHERE lista_id = $this->id ");
     $stmt->execute();
     $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);
     foreach($filas as $fila){
        $id = $fila['id'];
        $titulo = $fila['titulo'];
        $artista = $fila['artista'];
        $genero = $fila['genero'];

        $cancion = new Cancion($id, $titulo, $artista, $genero);
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
                $id_cancion = $cancion->getID();
                $DL_cancion = $this->conexion->prepare("DELETE FROM canciones WHERE id = :id");
                $DL_cancion->bindParam(':id', $id_cancion, PDO::PARAM_INT);
                $DL_cancion->execute();
                unset($this->Canciones[$indice]);
            }
        }
    }
    public function modificarCancion($nombre){
      foreach($this->Canciones as $cancion){
        if($cancion->getCancion() == $nombre){
            $id_cancion = $cancion->getID();
            $opcion = readline("elija 1 (artista) o 2 (genero): ");
            if($opcion == 1){
                $newArtisrta = readline("modifique el artista: ");
                if($newArtisrta != null){
                    $UD_artista = $this->conexion->prepare("UPDATE canciones SET artista = :a WHERE id = :id");
                    $UD_artista->bindParam(':a', $newArtisrta, PDO::PARAM_INT);
                    $UD_artista->bindParam(':id', $id_cancion, PDO::PARAM_INT);
                    $UD_artista->execute();
                    $cancion->setArtista($newArtisrta);
                }
            }
            if($opcion == 2){
                $newGenero = readline("modifique el genero: ");
                if($newGenero != null){
                    $UD_genero = $this->conexion->prepare("UPDATE canciones SET genero = :g WHERE id = :id");
                    $UD_genero->bindParam(':g', $newGenero, PDO::PARAM_INT);
                    $UD_genero->bindParam(':id', $id_cancion, PDO::PARAM_INT);
                    $UD_genero->execute();
                    $cancion->setGenero($newGenero);
                }
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
 











