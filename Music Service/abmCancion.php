<?php
require_once('abmLista.php');
class Cancion{
    private $Nombre;
    private $Artista;
    private $Genero;
    public function __construct($Nombre,$Artista,$Genero){
        $this->Nombre = $Nombre;
        $this->Artista = $Artista;
        $this->Genero = $Genero;
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

$cancion1 = new Cancion("s-class","stray kids","kpop");
$cancion2 = new Cancion("love dive","IVE","kpop");
$cancion3 = new Cancion("mic drop","BTS","kpop");
$kpop = new Lista("kpop");
$kpop->guardarCancion($cancion1);
$kpop->guardarCancion($cancion2);
//$kpop->getCanciones();