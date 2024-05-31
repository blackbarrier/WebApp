<?php

namespace App\Entity;

use App\Repository\ObrasocialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObrasocialRepository::class)]
class Obrasocial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $obraSocial = null;

    #[ORM\Column(length: 255)]
    private ?string $NombreCompleto = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObraSocial(): ?string
    {
        return $this->obraSocial;
    }

    public function setObraSocial(string $obraSocial): static
    {
        $this->obraSocial = $obraSocial;

        return $this;
    }

    public function getNombreCompleto(): ?string
    {
        return $this->NombreCompleto;
    }

    public function setNombreCompleto(string $NombreCompleto): static
    {
        $this->NombreCompleto = $NombreCompleto;

        return $this;
    }
}
