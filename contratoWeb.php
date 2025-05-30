<?php

require_once "contrato.php";

class ContratoWeb extends Contrato{

    private $porcentajeDescuento;

    public function __construct($fechaInicio, $fechaVencimiento, $plan, $estado, $renueva, $refCliente){
        parent::__construct($fechaInicio, $fechaVencimiento, $plan, $estado, $renueva, $refCliente);
        $this->porcentajeDescuento = 10;    
    }

    //Setters
    public function getPorcentajeDescuento(){return $this->porcentajeDescuento;}

    //Getters
    public function setPorcentajeDescuento($porcentajeDescuento){$this->porcentajeDescuento = $porcentajeDescuento;}

    //Si se trata de un contrato realizado via web al importe del mismo se le aplica un porcentaje de descuento que por defecto es del 10%.
    public function calcularImporte(){
        $importe = $this->getImporte(); //llama a la funcion del padre

        $descuento = $importe * $this->getPorcentajeDescuento() / 100;

        $importeFinal = $importe - $descuento;

        return $importeFinal;
    }

    // Metodo toString()
    public function __toString() {
        return parent::__toString() . "\nPorcentajeDescuento:" . $this->getPorcentajeDescuento();
    }
}

?>