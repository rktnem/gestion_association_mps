<?php

namespace App\Entity;

use App\Repository\ServicesDirectionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesDirectionsRepository::class)]
class ServicesDirections
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Services $services = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Directions $directions = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getServices(): ?Services
    {
        return $this->services;
    }

    public function setServices(?Services $services): static
    {
        $this->services = $services;

        return $this;
    }

    public function getdirections(): ?Directions
    {
        return $this->directions;
    }

    public function setDirections(?Directions $directions): static
    {
        $this->directions = $directions;

        return $this;
    }
}
