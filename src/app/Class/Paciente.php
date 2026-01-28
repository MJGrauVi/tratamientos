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




    public function __construct( string $nombre, string $numero_sip, DateTime $fecha_nacimiento, string $alergias)
    {
        $this->nombre = $nombre;
        $this->numero_sip = $numero_sip;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->alergias = $alergias;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Paciente
    {
        $this->id = $id;
        return $this;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): Paciente
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getNumeroSip(): string
    {
        return $this->numero_sip;
    }

    public function setNumeroSip(string $numero_sip): Paciente
    {
        $this->numero_sip = $numero_sip;
        return $this;
    }

    public function getFechaNacimiento(): DateTime
    {
        return $this->fecha_nacimiento;
    }

    public function setFechaNacimiento(DateTime $fecha_nacimiento): Paciente
    {
        $this->fecha_nacimiento = $fecha_nacimiento;
        return $this;
    }

    public function getAlergias(): string
    {
        return $this->alergias;
    }

    public function setAlergias(string $alergias): Paciente
    {
        $this->alergias = $alergias;
        return $this;
    }

    public function getTratamientosAsignados(): array
    {
        return $this->tratamientos_asignados;
    }

    public function setTratamientosAsignados(array $tratamientos_asignados): Paciente
    {
        $this->tratamientos_asignados = $tratamientos_asignados;
        return $this;
    }


    public function jsonSerialize(): mixed
    {
       return [
         /*  'id' => $this->id,*/
           'nombre' => $this->nombre,
           'numero_sip' => $this->numero_sip,
           'fecha_nacimiento' => $this->fecha_nacimiento,
           'alergias' => $this->alergias,
         /*  'tratamientos_asignados' => $this->tratamientos_asignados*/
       ];
    }

    public static function createFromArray(array $datos): Paciente
    {
        $fechaNacimiento = DateTime::createFromFormat('Y-m-d', $datos['fecha_nacimiento'])
            ?: DateTime::createFromFormat('d-m-Y', $datos['fecha_nacimiento']);

        $paciente = new Paciente(
            $datos['nombre'],
            $datos['numero_sip'],
            $fechaNacimiento,
            $datos['alergias']
        );

        // Asignar ID si existe
        if (isset($datos['id'])) {
            $paciente->id = (int)$datos['id'];
        }

        return $paciente;
    }

}