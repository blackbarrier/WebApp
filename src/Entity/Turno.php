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
}
