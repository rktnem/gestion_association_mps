<?php

namespace App\Entity;

use App\Repository\GradeCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GradeCategoriesRepository::class)]
class GradeCategories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Grade $Grade = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $Categorie = null;

    /**
     * @var Collection<int, InformationPersonnel>
     */
    #[ORM\OneToMany(targetEntity: InformationPersonnel::class, mappedBy: 'GradeCategorie', orphanRemoval: true)]
    private Collection $informationPersonnels;

 
    private Collection $historiqueEmployes;

    #[ORM\Column]
    private ?int $annee_supplementaire = null;

    /**
     * @var Collection<int, Historiques>
     */
    #[ORM\OneToMany(targetEntity: Historiques::class, mappedBy: 'GradeCategorie')]
    private Collection $historiques;

    public function __construct()
    {
        $this->informationPersonnels = new ArrayCollection();
        $this->historiqueEmployes = new ArrayCollection();
        $this->historiques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGrade(): ?Grade
    {
        return $this->Grade;
    }

    public function setGrade(?Grade $Grade): static
    {
        $this->Grade = $Grade;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->Categorie;
    }

    public function setCategorie(?Categorie $Categorie): static
    {
        $this->Categorie = $Categorie;

        return $this;
    }

    /**
     * @return Collection<int, InformationPersonnel>
     */
    public function getInformationPersonnels(): Collection
    {
        return $this->informationPersonnels;
    }

    public function addInformationPersonnel(InformationPersonnel $informationPersonnel): static
    {
        if (!$this->informationPersonnels->contains($informationPersonnel)) {
            $this->informationPersonnels->add($informationPersonnel);
            $informationPersonnel->setGradeCategorie($this);
        }

        return $this;
    }

    public function removeInformationPersonnel(InformationPersonnel $informationPersonnel): static
    {
        if ($this->informationPersonnels->removeElement($informationPersonnel)) {
            // set the owning side to null (unless already changed)
            if ($informationPersonnel->getGradeCategorie() === $this) {
                $informationPersonnel->setGradeCategorie(null);
            }
        }

        return $this;
    }

    public function getHistoriqueEmployes(): Collection
    {
        return $this->historiqueEmployes;
    }


    public function getAnneeSupplementaire(): ?int
    {
        return $this->annee_supplementaire;
    }

    public function setAnneeSupplementaire(int $annee_supplementaire): static
    {
        $this->annee_supplementaire = $annee_supplementaire;

        return $this;
    }

    /**
     * @return Collection<int, Historiques>
     */
    public function getHistoriques(): Collection
    {
        return $this->historiques;
    }

    public function addHistorique(Historiques $historique): static
    {
        if (!$this->historiques->contains($historique)) {
            $this->historiques->add($historique);
            $historique->setGradeCategorie($this);
        }

        return $this;
    }

    public function removeHistorique(Historiques $historique): static
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getGradeCategorie() === $this) {
                $historique->setGradeCategorie(null);
            }
        }

        return $this;
    }
}
