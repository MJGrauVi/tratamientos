<?php

namespace App\Model;

use App\Class\Medicamento;
use PDO;
class MedicamentoModel
{
    public static function getMedicamentoById($id): ? Medicamento{
        try{
            $conexion = new PDO('mysql:host=mariadb;dbname=paciente',
                'alumno',
                'alumno');
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            error_log($e->getMessage());
            return null;
        }
        $sql = "SELECT * FROM medicamentos WHERE id = :id";
        $stmt= $conexion->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();
        $medicamento = $stmt->fetch(PDO::FETCH_ASSOC);
        return $medicamento ? Medicamento::createFromArray($medicamento) : null;
    }

}