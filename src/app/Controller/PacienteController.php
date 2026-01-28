<?php

namespace App\Controller;

use App\Interface\ControllerInterface;

use App\Model\PacienteModel;
use App\Class\Paciente;

class PacienteController implements ControllerInterface
{

    function index()
    {
        // TODO: Implement index() method.
    }

    function show($id)
    {
        // TODO: Implement show() method.
    }

    function store()
    {

        $paciente = Paciente::createFromArray($_POST);
        PacienteModel::savePaciente($paciente);
    }

    function update($id)
    {
        // TODO: Implement update() method.
    }

    function destroy($id)
    {
        PacienteModel::deletePaciente($id);
        http_response_code(200);
        return json_encode([
            "error"=>false,
            "message"=>"El paciente con $id se ha borrado correctamente",
            "code"=>200
        ]);
    }
}