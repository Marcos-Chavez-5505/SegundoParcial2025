<?php


class Planes{
    // Definición de Variables
    private $codigo;
    private $canales;
    private $importe;
    private $incluyeMG;
    

    // Constructor
    public function __construct($codigo, $canales, $importe, $incluyeMG){
        $this->codigo = $codigo;
        $this->canales = $canales;
        $this->importe = $importe;
        $this->incluyeMG = 100;
    }

    // Getters
    public function getCodigo(){return $this->codigo;}
    public function getCanales(){return $this->canales;}
    public function getImporte(){return $this->importe;}
    public function getIncluyeMG(){return $this->incluyeMG;}


    // Setters
    public function setCodigo($codigo){$this->codigo = $codigo;}
    public function setCanales($canales){$this->canales = $canales;}
    public function setImporte($importe){$this->importe = $importe;}
    public function setIncluyeMG($incluyeMG){$this->incluyeMG = $incluyeMG;}


    // Metodo toString()
    public function __toString() {
        return "\nCodigo: " . $this->getCodigo() .
               "\nCanales: " . $this->getCanales() .
               "\nImporte: " . $this->getImporte() .
               "\nIncluyeMG: " . $this->getIncluyeMG();
    }
}


?>