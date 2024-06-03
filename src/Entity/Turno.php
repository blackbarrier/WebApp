<?php

namespace App\Entity;

use App\Repository\TurnoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TurnoRepository::class)]
class Turno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $fechaSolicitado = null;

    #[ORM\ManyToOne(inversedBy: 'turnos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?EstadoTurno $estado = null;

    #[ORM\Column]
    private ?int $paciente = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column]
    private ?int $severidad = 1;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Medico $medico = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFechaSolicitado(): ?\DateTimeInterface
    {
        return $this->fechaSolicitado;
    }

    public function setFechaSolicitado(\DateTimeInterface $fechaSolicitado): static
    {
        $this->fechaSolicitado = $fechaSolicitado;

        return $this;
    }

    public function getEstado(): ?EstadoTurno
    {
        return $this->estado;
    }

    public function setEstado(?EstadoTurno $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getPaciente(): ?int
    {
        return $this->paciente;
    }

    public function setPaciente(int $paciente): static
    {
        $this->paciente = $paciente;

        return $this;
    }


    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getSeveridad(): ?int
    {
        return $this->severidad;
    }

    public function setSeveridad(int $severidad): static
    {
        $this->severidad = $severidad;

        return $this;
    }

    public function getMedico(): ?Medico
    {
        return $this->medico;
    }

    public function setMedico(?Medico $medico): static
    {
        $this->medico = $medico;

        return $this;
    }
}
