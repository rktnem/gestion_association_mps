<?php

namespace App\Entity;

use App\Repository\InformationPersonnelRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationPersonnelRepository::class)]
class InformationPersonnel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_conjoint = null; 

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $nombre_enfant = null;

 

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?SituationFamiliale $situation = null;

    #[ORM\OneToOne(mappedBy:"informationPersonnel",targetEntity:Employes::class)]
    private ?Employes $employe = null;


    #[ORM\ManyToOne]
    private ?Specialisation $specialite = null;

    #[ORM\ManyToOne(inversedBy: 'informationPersonnels')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GradeCategories $GradeCategorie = null;

    #[ORM\Column(length: 255, nullable: true)]
 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $date_naissance): static
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getLieuNaissance(): ?string
    {
        return $this->lieu_naissance;
    }

    public function setLieuNaissance(string $lieu_naissance): static
    {
        $this->lieu_naissance = $lieu_naissance;

        return $this;
    }

    public function getNomConjoint(): ?string
    {
        return $this->nom_conjoint;
    }

    public function setNomConjoint(string $nom_conjoint): static
    {
        $this->nom_conjoint = $nom_conjoint;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNombreEnfant(): ?int
    {
        return $this->nombre_enfant;
    }

    public function setNombreEnfant(int $nombre_enfant): static
    {
        $this->nombre_enfant = $nombre_enfant;

        return $this;
    }

    public function getSituation(): ?SituationFamiliale
    {
        return $this->situation;
    }

    public function setSituation(?SituationFamiliale $situation): static
    {
        $this->situation = $situation;

        return $this;
    }

    public function getEmploye(): ?Employes
    {
        return $this->employe;
    }

    public function setEmploye(Employes $employe): static
    {
        $this->employe = $employe;

        return $this;
    }


    public function getSpecialite(): ?Specialisation
    {
        return $this->specialite;
    }

    public function setSpecialite(?Specialisation $specialite): static
    {
        $this->specialite = $specialite;

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


}
