<?php

namespace App\Model;

use PDO;
use PDOException;
use App\Class\Paciente;

class PacienteModel
{
    public static function deletePaciente($id):bool{
        try{
            $conexion = new PDO("mysql:host=mariadb;dbname=paciente","alumno", "alumno");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, Pdo::ERRMODE_EXCEPTION);
        }catch(PdoException $e){
            echo $e->getMessage();
            return false;
        }
        $sql = "DELETE FROM pacientes WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

    public static function savePaciente(Paciente $paciente): bool
    {
        try {
            $conexion = new PDO(
                "mysql:host=mariadb;dbname=paciente",
                "alumno",
                "alumno"
            );
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO pacientes (nombre, numero_sip, fecha_nacimiento, alergias)
                VALUES (:nombre, :numero_sip, :fecha_nacimiento, :alergias)";

            $stmt = $conexion->prepare($sql);
            $stmt->bindValue('nombre', $paciente->getNombre());
            $stmt->bindValue('numero_sip', $paciente->getNumeroSip());
            $stmt->bindValue(
                'fecha_nacimiento',
                $paciente->getFechaNacimiento()->format('Y-m-d')
            );
            $stmt->bindValue('alergias', $paciente->getAlergias());

            $stmt->execute();

            return $stmt->rowCount() > 0;

        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    /*    public static function savePaciente (Paciente $paciente):bool{
            try{
                $conexion = new PDO("mysql:host=mariadb;dbname=paciente","alumno", "alumno");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, Pdo::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            $sql= "INSERT INTO pacientes (nombre, numero_sip, fecha_nacimiento, alergias) VALUES(:nombre, :numero_sip, :fecha_nacimiento, :alergias)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindValue('nombre', $paciente->getNombre());
            $stmt->bindValue('numero_sip', $paciente->getNumeroSip());
            $stmt->bindValue('fecha_nacimiento', $paciente->getFechaNacimiento()->format('Y-m-d'));
            $stmt->bindValue('alergias', $paciente->getAlergias());
            $stmt->execute();
            if($stmt->rowCount() >0) {
                return true;
            }else{
                return false;
            }
        }*/

}