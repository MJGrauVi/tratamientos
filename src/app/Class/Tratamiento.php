<?php

namespace App\Class;

class Tratamiento implements \JsonSerializable
{
private int $id;
private string $codigo_tratamiento;
private string $diagnostico;
private int $duracion_dias;
private array $medicamentos;

    public function __construct(string $codigo_tratamiento, string $diagnostico, int $duracion_dias)
    {

        $this->codigo_tratamiento = $codigo_tratamiento;
        $this->diagnostico = $diagnostico;
        $this->duracion_dias = $duracion_dias;
        $this->medicamentos = [];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Tratamiento
    {
        $this->id = $id;
        return $this;
    }

    public function getCodigoTratamiento(): string
    {
        return $this->codigo_tratamiento;
    }

    public function setCodigoTratamiento(string $codigo_tratamiento): Tratamiento
    {
        $this->codigo_tratamiento = $codigo_tratamiento;
        return $this;
    }

    public function getDiagnostico(): string
    {
        return $this->diagnostico;
    }

    public function setDiagnostico(string $diagnostico): Tratamiento
    {
        $this->diagnostico = $diagnostico;
        return $this;
    }

    public function getDuracionDias(): int
    {
        return $this->duracion_dias;
    }

    public function setDuracionDias(int $duracion_dias): Tratamiento
    {
        $this->duracion_dias = $duracion_dias;
        return $this;
    }

    public function getMedicamentos(): array
    {
        return $this->medicamentos;
    }

    public function setMedicamentos(array $medicamentos): Tratamiento
    {
        $this->medicamentos = $medicamentos;
        return $this;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'codigo_tratamiento' => $this->codigo_tratamiento,
            'diagnostico' => $this->diagnostico,
            'duracion_dias' => $this->duracion_dias,
            'medicamentos' => $this->medicamentos

        ];
    }
    public static function createFromArray(array $array):?Tratamiento
    {
         $tratamiento =  new Tratamiento(
            $array['codigo_tratamiento'],
            $array['diagnostico'],
            $array['duracion_dias']

        );
         return $tratamiento;
    }
    /*La clase Tratamiento tiene un método addMedicamento($medicamento) que permite añadir objetos de tipo
    Medicamento al array de medicamentos del tratameinto.*/
   public function addMedicamento(Medicamento $medicamento): void{
        $this->medicamentos[]= $medicamento;
    }
    public function calcularCosteMedio():float{
        $totalMedicamentos = count($this->medicamentos);
        if($totalMedicamentos === 0){
            return 0;
        }
        $sumaPrecios = 0.0;

        foreach ($this->medicamentos as $medicamento) {
            $precio = $medicamento->getPrecio();
            $sumaPrecios += $precio;
        }
        $coste = $sumaPrecios / $totalMedicamentos;
        return $coste;


}
}