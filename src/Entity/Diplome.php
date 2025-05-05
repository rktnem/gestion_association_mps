<?php

namespace App\Entity;

use App\Repository\DiplomeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DiplomeRepository::class)]
class Diplome
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $niveau = null;

    #[ORM\OneToOne(mappedBy: 'diplome', cascade: ['persist', 'remove'])]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        // unset the owning side of the relation if necessary
        if ($categorie === null && $this->categorie !== null) {
            $this->categorie->setDiplome(null);
        }

        // set the owning side of the relation if necessary
        if ($categorie !== null && $categorie->getDiplome() !== $this) {
            $categorie->setDiplome($this);
        }

        $this->categorie = $categorie;

        return $this;
    }
}
