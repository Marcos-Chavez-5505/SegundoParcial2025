<?php


class Contrato{
    // Definición de Variables
    private $fechaInicio;
    private $fechaVencimiento;
    private $plan;
    private $estado;
    private $renueva;
    private $refCliente;

    // Constructor
    public function __construct($fechaInicio, $fechaVencimiento, $plan, $estado, $renueva, $refCliente){
        $this->fechaInicio = $fechaInicio;
        $this->fechaVencimiento = $fechaVencimiento;
        $this->plan = $plan;
        $this->estado = $estado;
        $this->renueva = $renueva;
    }

    // Getters
    public function getFechaInicio(){return $this->fechaInicio;}
    public function getFechaVencimiento(){return $this->fechaVencimiento;}
    public function getPlan(){return $this->plan;}
    public function getEstado(){return $this->estado;}
    public function getRenueva(){return $this->renueva;}
    public function getRefCliente(){return $this->refCliente;}

    // Setters
    public function setFechaInicio($fechaInicio){$this->fechaInicio = $fechaInicio;}
    public function setFechaVencimiento($fechaVencimiento){$this->fechaVencimiento = $fechaVencimiento;}
    public function setPlan($plan){$this->plan = $plan;}
    public function setEstado($estado){$this->estado = $estado;}
    public function setRenueva($renueva){$this->renueva = $renueva;}
    public function setRefCliente($refCliente){$this->refCliente = $refCliente;}


    //Un contrato se considera en estado moroso cuando su fecha de vencimiento ha sido superada, en caso de que pasen 10 días al vencimiento el estado cambiará de moroso a suspendido; caso contrario el contrato se encuentra al día. Antes de que un cliente realice un pago se debe verificar su estado.

    public function actualizarEstadoContrato(){
        
        $diasVencimiento = $this->diasContratoVencido();
        
        $estado = "al dia";

        if($diasVencimiento > 0 && $diasVencimiento < 10){
            $estado = "moroso";
        }
        elseif($diasVencimiento >= 10){
            $estado = "suspendido";
        }

        $this->setEstado($estado);

        return $estado;
    }

    // El importe final de un contrato realizado en la empresa se calcula sobre el importe del plan más los importes parciales de cada uno de los canales que lo forman.
    public function calcularImporte(){

        $plan = $this->getPlan();

        $importePlan = $plan->getImporte();
        $canales = $plan->getCanales(); //coleccion de canales
        $importeCanales = 0;

        foreach($canales as $canal){
            $importeCanales += $canal->getImporte();
        }

        $importeFinal = $importePlan + $importeCanales;

        return $importeFinal;
    }

    // Metodo toString()
    public function __toString() {
        return "\nFechaInicio: " . $this->getFechaInicio() .
               "\nFechaVencimiento: " . $this->getFechaVencimiento() .
               "\nPlan: " . $this->getPlan() .
               "\nEstado: " . $this->getEstado() .
               "\nRenueva: " . $this->getRenueva() .
               "\nRefCliente: " . $this->getRefCliente();
    }
}


?>