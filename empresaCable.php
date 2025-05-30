<?php

//Una empresa TxC de Televisión por Cable desea sistematizar el contrato de los planes que ofrece a sus clientes. Para ello desea almacenar información de los planes, canales, clientes y los contratos de los planes. El contrato de los planes puede realizarse vía web o en la oficina de la empresa de cable.


class EmpresaCable{
    // Definición de Variables
    private $planes;
    private $canales;
    private $clientes;
    private $contratos;

    // Constructor
    public function __construct($planes, $canales, $clientes, $contratos){
        $this->planes = $planes;
        $this->canales = $canales;
        $this->clientes = $clientes;
        $this->contratos = $contratos;
    }

    // Getters
    public function getPlanes(){return $this->planes;}
    public function getCanales(){return $this->canales;}
    public function getClientes(){return $this->clientes;}
    public function getContratos(){return $this->contratos;}

    // Setters
    public function setPlanes($planes){$this->planes = $planes;}
    public function setCanales($canales){$this->canales = $canales;}
    public function setClientes($clientes){$this->clientes = $clientes;}
    public function setContratos($contratos){$this->contratos = $contratos;}

    public function incorporarPlan($planParam){
        //no deja claro el enunciado pero supongo que se incorpora un plan por parametro
        $planes = $this->getPlanes();

        $incorporacion = $true;

        $i = 0;
        $flag = true;
        
        while($i < count($planes) && $flag){
            $plan = $planes[$i];

            if($plan->getIncluyeMG() == $planParam->getIncluyeMG()){
                $incorporacion = false;
                $flag = false;
            }
            $i++;
        }

        //Si me hacen el favor de explicar como comparo dos objetos canales para saber si tienen los mismos canales se los agradezco, nunca en la vida vi algo asi.

        if($incorporacion){
            $planes[] = $planParam;
            $this->setPlanes($planes);
        }
        
        
    }

    public function buscarContrato($tipoDoc, $numDoc){

        $contratos = $this->getContratos();
        $contratoCliente = null;

        $i = 0;
        $flag = true;
        
        while($i < count($contratos) && $flag){
            $contrato = $contratos[$i];
            $cliente = $contrato->getRefCliente();
            if($cliente->getTipoDoc() == $tipoDoc && $cliente->getNumDoc() == $numDoc){
                $contratoCliente = $contrato;
                $flag = false;
            }
            $i++;
        }

        return $contratoCliente;

    }

    public function incorporarContrato($plan, $refCliente, $fechaInicio, $fechaVencimiento, $tipoContrato){

        $contratos = $this->getContratos();

        $tipoDoc = $refCliente->getTipoDoc();
        $numDoc = $refCliente->getNumDoc();

        $contrato = $this->buscarContrato($tipoDoc, $numDoc);

        if($contrato !== null){
            //lo que entiendo cuando dicen dar de baja (no existe otra variable que verifique eso)
            $contrato->setEstado("finalizado");
        }
        else{

            if($tipoContrato){
                $nuevoContrato = new ContratoWeb($fechaInicio, $fechaVencimiento, $plan, "al dia", true, $refCliente);
            }else{
                $nuevoContrato = new ContratoEmpresa($fechaInicio, $fechaVencimiento, $plan, "al dia", true, $refCliente);
            }
        }

        $contratos[] = $nuevoContrato;
        $this->setContratos($nuevoContrato);

    }

    public function retornarPromImporteContratos($codigoPlan){
        $contratos = $this->getContratos();

   
        $colContratos = null;
        $sumaImportes = 0;

        foreach($contratos as $contrato){
            $plan = $contrato->getPlan();

            if($plan->getCodigo() == $codigoPlan){
                $colContratos[] = $contrato;
            }            
        }

        if($contratoEncontrado !== null){
            foreach($colContratos as $contrato){
                $sumaImportes += $contrato->calcularImporte();
            }
        }

        $promedioImporte = $sumaImportes / count($colContratos);

        return $promedioImporte;
    }

    public function pagarContrato($codigoContrato){
        
        $contratos = $this->getContratos();

        $contratoEncontrado = null;

        $i = 0;
        $flag = true;
        
        while($i < count($contratos) && $flag){
            $contrato = $contratos[$i];

            if($contrato->getCodigo() == $codigoContrato){
                $contratoEncontrado = $contrato;
                $flag = false;
            }

            $i++;
        }

        if($contratoEncontrado !== null){

        $estado = $contratoEncontrado->getEstado();
        $importeFinal = $contratoEncontrado->calcularImporte();

        $diasVencido = $contratoEncontrado->diasContratoVencido();

        if ($estado == "al día"){
            $contratoEncontrado->setRenueva(true);

        }
        elseif ($estado == "moroso"){
            $multa = $importeBase * 0.10 * $diasMora;
            $importeFinal += $multa;
            $contratoEncontrado->setEstado('al día');
            $contratoEncontrado->renueva(true);

        }
        elseif ($estado == "suspendido") {
            $multa = $importeBase * 0.10 * $diasMora;
            $importeFinal += $multa;

        }
        elseif ($estado == "finalizado") {
            return "El contrato está finalizado y no puede pagarse.";
        }
        }
    
        return $importeFinal;
    }

    // Metodo toString()
    public function __toString() {
        return "\nPlanes: " . $this->getPlanes() .
               "\nCanales: " . $this->getCanales() .
               "\nClientes: " . $this->getClientes() .
               "\nContratos: " . $this->getContratos();
    }
}


?>