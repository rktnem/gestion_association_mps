<?php

namespace App\Entity;

use App\Repository\HistoriquesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoriquesRepository::class)]
class Historiques
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    private ?Employes $Employe = null;

    #[ORM\ManyToOne(inversedBy: 'historiques')]
    private ?GradeCategories $GradeCategorie = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date_dernier_promotion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmploye(): ?Employes
    {
        return $this->Employe;
    }

    public function setEmploye(?Employes $Employe): static
    {
        $this->Employe = $Employe;

        return $this;
    }

    public function getGradeCategorie(): ?GradeCategories
    {
        return $this->GradeCategorie;
    }

    public function setGradeCategorie(?GradeCategories $GradeCategorie): static
    {
        $this->GradeCategorie = $GradeCategorie;

        return $this;
    }

    public function getDateDernierPromotion(): ?\DateTimeInterface
    {
        return $this->Date_dernier_promotion;
    }

    public function setDateDernierPromotion(\DateTimeInterface $Date_dernier_promotion): static
    {
        $this->Date_dernier_promotion = $Date_dernier_promotion;

        return $this;
    }
}
