<?php

namespace App\Entity;

use App\Repository\EstadoTurnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadoTurnoRepository::class)]
class EstadoTurno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    /**
     * @var Collection<int, Turno>
     */
    #[ORM\OneToMany(targetEntity: Turno::class, mappedBy: 'estado')]
    private Collection $turnos;

    public function __construct()
    {
        $this->turnos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Turno>
     */
    public function getTurnos(): Collection
    {
        return $this->turnos;
    }

    public function addTurno(Turno $turno): static
    {
        if (!$this->turnos->contains($turno)) {
            $this->turnos->add($turno);
            $turno->setEstado($this);
        }

        return $this;
    }

    public function removeTurno(Turno $turno): static
    {
        if ($this->turnos->removeElement($turno)) {
            // set the owning side to null (unless already changed)
            if ($turno->getEstado() === $this) {
                $turno->setEstado(null);
            }
        }

        return $this;
    }
}
