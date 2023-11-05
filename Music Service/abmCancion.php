<?php
require_once('abmLista.php');
class Cancion{
    private $id;
    private $Nombre;
    private $Artista;
    private $Genero;
    public function __construct($id, $Nombre,$Artista,$Genero){
        $this->id = $id;
        $this->Nombre = $Nombre;
        $this->Artista = $Artista;
        $this->Genero = $Genero;
    }
    public function getID(){
        return $this->id;
    }
    public function getCancion(){ 
        return $this->Nombre;
    }
    public function getArtista(){
         return $this->Artista;
    }
    public function getGenero(){ 
        return $this->Genero;
    }
    public function setArtista($newArtista){
        $this->Artista = $newArtista;
    }
    public function setGenero($newGenero){
        $this->Genero = $newGenero;
    }
                

}

