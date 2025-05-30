<?php


class Canales{
    // Definición de Variables
    private $tipoCanal;
    private $importe;
    private $esHD;


    // Constructor
    public function __construct($tipoCanal, $importe, $esHD){
        $this->tipoCanal = $tipoCanal;
        $this->importe = $importe;
        $this->esHD = $esHD;
    }

    // Getters
    public function getTipoCanal(){return $this->tipoCanal;}
    public function getImporte(){return $this->importe;}
    public function getEsHD(){return $this->esHD;}


    // Setters
    public function setTipoCanal($tipoCanal){$this->tipoCanal = $tipoCanal;}
    public function setImporte($importe){$this->importe = $importe;}
    public function setEsHD($esHD){$this->esHD = $esHD;}


    // Metodo toString()
    public function __toString() {
        return "\nTipoCanal: " . $this->getTipoCanal() .
               "\nImporte: " . $this->getImporte() .
               "\nEsHD: " . $this->getEsHD();
    }
}


?>