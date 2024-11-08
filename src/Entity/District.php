<?php

namespace App\Entity;

use App\Repository\DistrictRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DistrictRepository::class)]
class District
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'districts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Region $regionId = null;

    /**
     * @var Collection<int, Commune>
     */
    #[ORM\OneToMany(targetEntity: Commune::class, mappedBy: 'district_id')]
    private Collection $communes;

    public function __construct()
    {
        $this->communes = new ArrayCollection();
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

    public function getRegionId(): ?Region
    {
        return $this->regionId;
    }

    public function setRegionId(?Region $regionId): static
    {
        $this->regionId = $regionId;

        return $this;
    }

    /**
     * @return Collection<int, Commune>
     */
    public function getCommunes(): Collection
    {
        return $this->communes;
    }

    public function addCommune(Commune $commune): static
    {
        if (!$this->communes->contains($commune)) {
            $this->communes->add($commune);
            $commune->setDistrictId($this);
        }

        return $this;
    }

    public function removeCommune(Commune $commune): static
    {
        if ($this->communes->removeElement($commune)) {
            // set the owning side to null (unless already changed)
            if ($commune->getDistrictId() === $this) {
                $commune->setDistrictId(null);
            }
        }

        return $this;
    }
}
