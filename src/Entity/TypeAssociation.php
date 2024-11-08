<?php

namespace App\Entity;

use App\Repository\TypeAssociationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeAssociationRepository::class)]
class TypeAssociation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    /**
     * @var Collection<int, Association>
     */
    #[ORM\OneToMany(targetEntity: Association::class, mappedBy: 'type_association')]
    private Collection $associations;

    public function __construct()
    {
        $this->associations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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
            $association->setTypeAssociation($this);
        }

        return $this;
    }

    public function removeAssociation(Association $association): static
    {
        if ($this->associations->removeElement($association)) {
            // set the owning side to null (unless already changed)
            if ($association->getTypeAssociation() === $this) {
                $association->setTypeAssociation(null);
            }
        }

        return $this;
    }
}
