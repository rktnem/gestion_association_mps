<?php

namespace App\Entity;

use App\Repository\CommuneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommuneRepository::class)]
class Commune
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'communes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?District $district_id = null;

    /**
     * @var Collection<int, Association>
     */
    #[ORM\OneToMany(targetEntity: Association::class, mappedBy: 'commune_id', orphanRemoval: true)]
    private Collection $associations;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDistrictId(): ?District
    {
        return $this->district_id;
    }

    public function setDistrictId(?District $district_id): static
    {
        $this->district_id = $district_id;

        return $this;
    }

    /**
     * @return Collection<int, Association>
     */
    public function getAssociations(): Collection
    {
        return $this->associations;
    }

    public function addAssociation(Association $association): static
    {
        if (!$this->associations->contains($association)) {
            $this->associations->add($association);
            $association->setCommuneId($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): static
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getCommuneId() === $this) {
                $association->setCommuneId(null);
            }
        }

        return $this;
    }
}
