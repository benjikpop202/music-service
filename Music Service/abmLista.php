<?php


class Lista{
    private $Nombre;
    private $Canciones;
    public function __construct($Nombre){
     $this->Nombre = $Nombre;
     $this->Canciones = [];
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

    public function eliminarCancion($nombre){
        foreach($this->Canciones as $indice => $cancion){
            if($cancion->getCancion() === $nombre){
                unset($this->Canciones[$indice]);
            }
        }
    }
    public function modificarCancion(){

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
       /* public function toJson() {
            return json_encode($this->toArray());
        }
        public static function fromJson($json) {
            $listaData = json_decode($json, true);
            return self::fromArray($listaData);
        }
        public function toArray() {
            return [
                'nombre' => $this->Nombre,
                'canciones' => $this->Canciones,
                
            ];
        }
        public static function fromArray($data) {
            $lista = new Lista($data['nombre']);
            foreach ($data['canciones'] as $cancionData) {
                $cancion = new Cancion($cancionData['nombre'], $cancionData['artista'], $cancionData['genero']);
                $lista->guardarCancion($cancion);
            }
            return $lista;
        }*/
        
                       
    }
 











