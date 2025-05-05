<?php

namespace App\Entity;

use App\Repository\EmployesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EmployesRepository::class)]
class Employes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column]
    private ?int $CIN = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 10, nullable: false)]
    #[Assert\Regex(
        pattern: '/^\d{10}$/'
    )]
    private ?string $contact = null;

    #[ORM\Column]
    private ?int $imatriculation = null;


    #[ORM\OneToOne(targetEntity: InformationPersonnel::class, inversedBy: 'employe', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    private ?InformationPersonnel $informationPersonnel = null;



    #[ORM\Column(type:'string',length:255,nullable:false)]
    private $photo = null;

    #[ORM\ManyToOne(targetEntity:Sexe::class,inversedBy:'employes')]
    #[ORM\JoinColumn(name:'sexe_id',onDelete:"CASCADE")]
    private ?sexe $sexe = null;

    #[ORM\ManyToOne(targetEntity:Fonction::class)]
    #[ORM\JoinColumn(nullable: false,onDelete:"CASCADE")]
    private ?Fonction $fonction = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_delivrance_CIN = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEntree = null;
       public function __construct()
    {
    
        $this->dateEntree = new \DateTime();
        $this->historiques = new ArrayCollection();
    }

    #[ORM\ManyToOne(targetEntity:RegionDistrict::class)]
    #[ORM\JoinColumn(nullable: false,onDelete:"CASCADE")]
    private ?RegionDistrict $Regiondistrict = null;

    #[ORM\Column]
    private ?bool $deleted = false;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $DeleteAt = null;

    #[ORM\ManyToOne]
    private ?RaisonDeSuppression $raison = null;

    #[ORM\ManyToOne(targetEntity:ServicesDirections::class)]
    #[ORM\JoinColumn(nullable: false,onDelete:"CASCADE")]
    private ?ServicesDirections $servicesdirections = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $Contrat = null;

    #[ORM\ManyToOne(inversedBy: 'employes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $status = null;

    /**
     * @var Collection<int, Historiques>
     */
    #[ORM\OneToMany(targetEntity: Historiques::class, mappedBy: 'Employe')]
    private Collection $historiques;



    #[ORM\ManyToOne]
    
    
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCIN(): ?int
    {
        return $this->CIN;
    }

    public function setCIN(int $CIN): static
    {
        $this->CIN = $CIN;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getContact(): ?int
    {
        return $this->contact;
    }

    public function setContact(int $contact): static
    {
        $this->contact = $contact;

        return $this;
    }

    public function getImatriculation(): ?int
    {
        return $this->imatriculation;
    }

    public function setImatriculation(int $imatriculation): static
    {
        $this->imatriculation = $imatriculation;

        return $this;
    }

    public function getInformationPersonnel():?InformationPersonnel
    {
        return $this->informationPersonnel;
    }
    public function setInformationPersonnel(?InformationPersonnel $informationPersonnel): self
    {
        $this->informationPersonnel = $informationPersonnel;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): static
    {
        $this->photo = $photo;

        return $this;
    }

    public function getSexe(): ?sexe
    {
        return $this->sexe;
    }

    public function setSexe(?sexe $sexe): static
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getFonction(): ?Fonction
    {
        return $this->fonction;
    }

    public function setFonction(?Fonction $fonction): static
    {
        $this->fonction = $fonction;

        return $this;
    }

    public function getDateDelivranceCIN(): ?\DateTimeInterface
    {
        return $this->date_delivrance_CIN;
    }

    public function setDateDelivranceCIN(\DateTimeInterface $date_delivrance_CIN): static
    {
        $this->date_delivrance_CIN = $date_delivrance_CIN;

        return $this;
    }

    public function getDateEntree(): ?\DateTimeInterface
    {
        return $this->dateEntree;
    }

    public function setDateEntree(\DateTimeInterface $dateEntree): static
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    public function getRegiondistrict(): ?RegionDistrict
    {
        return $this->Regiondistrict;
    }

    public function setRegiondistrict(?RegionDistrict $Regiondistrict): static
    {
        $this->Regiondistrict = $Regiondistrict;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(bool $deleted): static
    {
        $this->deleted = $deleted;

        return $this;
    }

    public function getDeleteAt(): ?\DateTimeInterface
    {
        return $this->DeleteAt;
    }

    public function setDeleteAt(?\DateTimeInterface $DeleteAt): static
    {
        $this->DeleteAt = $DeleteAt;

        return $this;
    }

    public function getRaison(): ?RaisonDeSuppression
    {
        return $this->raison;
    }

    public function setRaison(?RaisonDeSuppression $raison): static
    {
        $this->raison = $raison;

        return $this;
    }

    public function getServicesdirections(): ?ServicesDirections
    {
        return $this->servicesdirections;
    }

    public function setServicesdirections(?ServicesDirections $servicesdirections): static
    {
        $this->servicesdirections = $servicesdirections;

        return $this;
    }

    public function getContrat(): ?string
    {
        return $this->Contrat;
    }

    public function setContrat(?string $Contrat): static
    {
        $this->Contrat = $Contrat;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

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
            $historique->setEmploye($this);
        }

        return $this;
    }

    public function removeHistorique(Historiques $historique): static
    {
        if ($this->historiques->removeElement($historique)) {
            // set the owning side to null (unless already changed)
            if ($historique->getEmploye() === $this) {
                $historique->setEmploye(null);
            }
        }

        return $this;
    }
}
