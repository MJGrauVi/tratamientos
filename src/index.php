<?php

include_once "vendor/autoload.php";


use Phroute\Phroute\Exception\HttpRouteNotFoundException;
use Phroute\Phroute\RouteCollector;
use App\Controller\MedicamentoController;
use App\Controller\PacienteController;


session_start();

$router = new RouteCollector();


$router->get('/',function (){
    include_once "app/View/principal.php";
});
$router->delete('/paciente/{id}', [PacienteController::class, 'destroy']);
$router->get('/medicamento/{id}', [MedicamentoController::class, 'show']);
$router->post('/paciente', [PacienteController::class, 'store']);
/*var_dump(class_exists('App\\Controller\\MedicamentoController'));
die;*/


//Pruebas del código:
/*use App\Class\Medicamento;
use App\Class\Tratamiento;

$medicamento1 = new Medicamento('IbuDolor', 'ibuprofeno', 5.20);
$medicamento2 = new Medicamento('paraDolor', 'paracetamol', 4.20);
$nuevoTratamiento= new Tratamiento('tt02', 'dolor',3);
$nuevoTratamiento->addMedicamento($medicamento1);
$nuevoTratamiento->addMedicamento($medicamento2);
echo "Coste del tratamiento: ";
$costeMedicamentos = $nuevoTratamiento->calcularCosteMedio();
echo "Coste medicamentos: " . $costeMedicamentos . "\t";
echo "*************************";
$dias= $nuevoTratamiento->getDuracionDias();
echo "Días de tratamiento: " . $dias;
$costeMedioPorDia = $costeMedicamentos * ($nuevoTratamiento->getDuracionDias());
echo "Coste medio por dia: ". $costeMedioPorDia;*/


//Resolución de rutas
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
try {
    $response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
}
catch(HttpRouteNotFoundException $e){
    return "Ruta no encontrada";
}
// Print out the value returned from the dispatched function
echo $response;
