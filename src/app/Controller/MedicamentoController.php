<?php



namespace App\Controller;

use App\Interface\ControllerInterface;
use App\Model\MedicamentoModel;


class MedicamentoController implements ControllerInterface
{
    public function show($id){
  
        $medicamento = MedicamentoModel::getMedicamentoById($id);
        header('Content-type: application/json; charset=UTF-8');
        if($medicamento == null){
            http_response_code(404);
            echo json_encode(["error"=> "medicamento no encontrado"]);
            return;
        }
        http_response_code(200);
        echo json_encode($medicamento);

    }
 
    function index()
    {
        // TODO: Implement index() method.
    }

    function store()
    {
        // TODO: Implement store() method.
    }

    function update($id)
    {
        // TODO: Implement update() method.
    }

    function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}