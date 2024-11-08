<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssociationRepository::class)]
class Association
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(nullable: true)]
    private ?int $membre = null;

    #[ORM\Column(length: 255)]
    private ?string $activite = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $besoin = null;

    #[ORM\ManyToOne(inversedBy: 'associations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commune $commune_id = null;

    #[ORM\ManyToOne(inversedBy: 'associations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeAssociation $type_assocation_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMembre(): ?int
    {
        return $this->membre;
    }

    public function setMembre(?int $membre): static
    {
        $this->membre = $membre;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function getBesoin(): ?string
    {
        return $this->besoin;
    }

    public function setBesoin(?string $besoin): static
    {
        $this->besoin = $besoin;

        return $this;
    }

    public function getCommuneId(): ?Commune
    {
        return $this->commune_id;
    }

    public function setCommuneId(?Commune $commune_id): static
    {
        $this->commune_id = $commune_id;

        return $this;
    }

    public function getTypeAssocationId(): ?TypeAssociation
    {
        return $this->type_assocation_id;
    }

    public function setTypeAssocationId(?TypeAssociation $type_assocation_id): static
    {
        $this->type_assocation_id = $type_assocation_id;

        return $this;
    }
}
