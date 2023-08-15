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
    }
 




$rock = new lista("rock");
$EDM = new Lista("EDM");






