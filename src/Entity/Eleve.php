<?php

namespace App\Entity;

use App\Repository\EleveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EleveRepository::class)
 */
class Eleve
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $prenom;


    /**
     * @ORM\Column(type="string", length=5)
     */
    private $promotion;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="ideleves")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Admin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tuteur;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $Specialite;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="eleves")
     */
    private $Enseignant;

    /**
     * @ORM\OneToMany(targetEntity=Cappfpmp::class, mappedBy="etudiant", cascade={"persist"})
     */
    private $cappfpmps;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $Classe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Formation;

    public function __construct()
    {
        $this->cappfpmps = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getClasse(): ?string
    {
        return $this->Classe;
    }

    public function setClasse(string $classe): self
    {
        $this->Classe = $classe;

        return $this;
    }

    public function getPromotion(): ?string
    {
        return $this->promotion;
    }

    public function setPromotion(string $promotion): self
    {
        $this->promotion = $promotion;

        return $this;
    }

    public function getAdmin(): ?utilisateur
    {
        return $this->Admin;
    }

    public function setAdmin(?utilisateur $Admin): self
    {
        $this->Admin = $Admin;

        return $this;
    }

    public function getTuteur(): ?string
    {
        return $this->tuteur;
    }

    public function setTuteur(string $tuteur): self
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getSpecialite(): ?string
    {
        return $this->Specialite;
    }

    public function setSpecialite(?string $Specialite): self
    {
        $this->Specialite = $Specialite;

        return $this;
    }

    public function getFormation(): ?string
    {
        return $this->Formation;
    }

    public function setFormation(?string $Formation): self
    {
        $this->Formation = $Formation;

        return $this;
    }

    public function getEnseignant(): ?Utilisateur
    {
        return $this->Enseignant;
    }

    public function setEnseignant(?Utilisateur $Enseignant): self
    {
        $this->Enseignant = $Enseignant;

        return $this;
    }

    /**
     * @return Collection<int, Cappfpmp>
     */
    public function getCappfpmps(): Collection
    {
        return $this->cappfpmps;
    }

    public function addCappfpmp(Cappfpmp $cappfpmp): self
    {
        if (!$this->cappfpmps->contains($cappfpmp)) {
            $this->cappfpmps[] = $cappfpmp;
            $cappfpmp->setEtudiant($this);
        }

        return $this;
    }

    public function removeCappfpmp(Cappfpmp $cappfpmp): self
    {
        if ($this->cappfpmps->removeElement($cappfpmp)) {
            // set the owning side to null (unless already changed)
            if ($cappfpmp->getEtudiant() === $this) {
                $cappfpmp->setEtudiant(null);
            }
        }

        return $this;
    }

    
}
