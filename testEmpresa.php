<?php

require_once "canales.php";
require_once "contrato.php";
require_once "contratoWeb.php";
require_once "empresaCable.php";
require_once "planes.php";

//canales
$canal1 = new Canales("Noticias", 200, true);
$canal2 = new Canales("Deportivo", 250, false);
$canal3 = new Canales("Infantil", 180, true);

$canales = [$canal1, $canal2, $canal3];

//Planes
$plan1 = new Planes(111, [$canal1, $canal2], 1200);
$plan2 = new Planes(222, [$canal2, $canal3], 1000); 

$planes = [$plan1, $plan2];

//cliente
$cliente1 = new Cliente("Roman", "Riquelme", "DNI", "12345678");

//empresa
$empresa = new EmpresaCable($planes, $canales, $cliente, []);


$contratoEmpresa = new Contrato("2025-05-30", "2025-6-30", $plan1, "al día", true, $cliente1);

//el porcentaje de descuento se iniciliza en el constructor, no se pasa por parametro
$contratoWeb1 = new ContratoWeb("2025-05-30", "2025-06-01", $plan2, "al día", true, $cliente1);
$contratoWeb2 = new ContratoWeb("2025-05-30", "2025-06-30", $plan1, "al día", true, $cliente1);

$importeEmpresa = $contratoEmpresa->calcularImporte();

$importeWeb1 = $contratoWeb1->calcularImporte();
$importeWeb2 = $contratoWeb2->calcularImporte();

echo $importeEmpresa;
echo $importeWeb1;
echo $importeWeb2;

$empresa->incorporarPlan($plan1);
$empresa->incorporarPlan($plan2);

$empresa->incorporarContrato($plan1, $cliente, "2025-05-30", "2025-06-30", false);

$empresa->incorporarContrato($plan2, $cliente, "2025-05-30", "2025-06-30", true);

$empresa->pagarContrato($contratoEmpresa);

$empresa->pagarContrato($contratoWeb1);

$empresa->retornarPromImporteContratos(111);

echo $empresa;




?>