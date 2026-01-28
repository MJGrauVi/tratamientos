<?php

namespace App\Class;
use DateTime;

class Paciente implements \JsonSerializable
{
private int $id;
private string $nombre;
private string $numero_sip;
private DateTime $fecha_nacimiento;
private string $alergias;
private array $tratamientos_asignados = [];

    /**
     * @param string $nombre
     * @param string $numero_sip
     * @param DateTime $fecha_nacimiento
     * @param string $alergias
     */
    public function __construct(string $nombre, string $numero_sip, DateTime $fecha_nacimiento, string $alergias)
    {
        $this->nombre = $nombre;
        $this->numero_sip = $numero_sip;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->alergias = $alergias;
    }


    public function jsonSerialize(): mixed
    {
       return [
           'id' => $this->id,
           'nombre' => $this->nombre,
           'numero_sip' => $this->numero_sip,
           'fecha_nacimiento' => $this->fecha_nacimiento,
           'alergias' => $this->alergias,
           'tratamientos_asignados' => $this->tratamientos_asignados
       ];
    }
}