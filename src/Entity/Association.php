<?php

namespace App\Entity;

use App\Repository\AssociationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activite = null;

    #[ORM\ManyToOne(inversedBy: 'associations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Commune $commune = null;

    #[ORM\ManyToOne(inversedBy: 'associations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeAssociation $type_association = null;

    /**
     * @var Collection<int, Besoin>
     */
    #[ORM\ManyToMany(targetEntity: Besoin::class)]
    #[ORM\JoinColumn(nullable: false)]
    private Collection $besoin;

    #[ORM\Column(length: 255)]
    private ?string $nom_president = null;

    #[ORM\Column]
    private ?bool $nif_stat = null;

    #[ORM\Column(length: 150)]
    private ?string $numero_recepisse = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $contact = null;

    public function __construct()
    {
        $this->besoin = new ArrayCollection();
    }

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

    public function getCommune(): ?Commune
    {
        return $this->commune;
    }

    public function setCommune(?Commune $commune): static
    {
        $this->commune = $commune;

        return $this;
    }

    public function getTypeAssociation(): ?TypeAssociation
    {
        return $this->type_association;
    }

    public function setTypeAssociation(?TypeAssociation $type_association): static
    {
        $this->type_association = $type_association;

        return $this;
    }

    /**
     * @return Collection<int, Besoin>
     */
    public function getBesoin(): Collection
    {
        return $this->besoin;
    }

    public function addBesoin(Besoin $besoin): static
    {
        if (!$this->besoin->contains($besoin)) {
            $this->besoin->add($besoin);
        }

        return $this;
    }

    public function removeBesoin(Besoin $besoin): static
    {
        $this->besoin->removeElement($besoin);

        return $this;
    }

    public function getNomPresident(): ?string
    {
        return $this->nom_president;
    }

    public function setNomPresident(string $nom_president): static
    {
        $this->nom_president = $nom_president;

        return $this;
    }

    public function isNifStat(): ?bool
    {
        return $this->nif_stat;
    }

    public function setNifStat(bool $nif_stat): static
    {
        $this->nif_stat = $nif_stat;

        return $this;
    }

    public function getNumeroRecepisse(): ?string
    {
        return $this->numero_recepisse;
    }

    public function setNumeroRecepisse(string $numero_recepisse): static
    {
        $this->numero_recepisse = $numero_recepisse;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(?string $contact): static
    {
        $this->contact = $contact;

        return $this;
    }
}