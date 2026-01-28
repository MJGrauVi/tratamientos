<?php

namespace app\Model;

use App\Class\Tratamiento;
use PDO;
use PDOException;

class TratamientoModel
{
public static function saveTratamiento(Tratamiento $tratamiento):?bool
{
    try {
        $conexion = new PDO("mysql:host=mariadb;dbname=paciente", "alumno", "alumno");
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $sql = "INSERT INTO tratamientos (codigo_tratamiento, diagnostico, duracion_dias)VALUES(:codigo_tratamiento, :diagnostico, :duracion_dias)";
    $stmt = $conexion->prepare($sql);
    $stmt->bindValue('codigo_tratamiento', $tratamiento->getCodigoTratamiento());
    $stmt->bindValue('diagnostico', $tratamiento->getDiagnostico());
    $stmt->bindValue('duracion_dias', $tratamiento->getDuracionDias());
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
public static function getTratamientoByNombre(string $nombre):?Tratamiento{

}


}