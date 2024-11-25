<?php

namespace App\Entity;

use App\Repository\BesoinRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BesoinRepository::class)]
class Besoin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_besoin = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBesoin(): ?string
    {
        return $this->nom_besoin;
    }

    public function setNomBesoin(string $nom_besoin): static
    {
        $this->nom_besoin = $nom_besoin;

        return $this;
    }
}