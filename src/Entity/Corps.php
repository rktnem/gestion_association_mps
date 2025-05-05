<?php

namespace App\Entity;

use App\Repository\CorpsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CorpsRepository::class)]
class Corps
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_corps = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCorps(): ?string
    {
        return $this->nom_corps;
    }

    public function setNomCorps(string $nom_corps): static
    {
        $this->nom_corps = $nom_corps;

        return $this;
    }
}
