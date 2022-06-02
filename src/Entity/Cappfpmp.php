<?php

namespace App\Entity;

use App\Repository\CappfpmpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CappfpmpRepository::class)
 */
class Cappfpmp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity=Eleve::class, inversedBy="cappfpmps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etudiant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enseignant;

    /**
     * @ORM\ManyToOne(targetEntity=Tuteur::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $tuteur;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datedebut;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datefin;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $absences;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cachet;

    /**
     * @ORM\OneToMany(targetEntity=Ligne::class, mappedBy="cappfpmp", cascade={"persist"})
     */
    private $lignes;


    public function __construct()
    {
        $this->lignes = new ArrayCollection();
        $this->Lignes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEtudiant(): ?eleve
    {
        return $this->etudiant;
    }

    public function setEtudiant(?eleve $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getEnseignant(): ?string
    {
        return $this->enseignant;
    }

    public function setEnseignant(string $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getTuteur(): ?tuteur
    {
        return $this->tuteur;
    }

    public function setTuteur(?tuteur $tuteur): self
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getDatedebut(): ?\DateTimeInterface
    {
        return $this->datedebut;
    }

    public function setDatedebut(\DateTimeInterface $datedebut): self
    {
        $this->datedebut = $datedebut;

        return $this;
    }

    public function getDatefin(): ?\DateTimeInterface
    {
        return $this->datefin;
    }

    public function setDatefin(\DateTimeInterface $datefin): self
    {
        $this->datefin = $datefin;

        return $this;
    }

    public function getAbsences(): ?int
    {
        return $this->absences;
    }

    public function setAbsences(int $absences): self
    {
        $this->absences = $absences;

        return $this;
    }

    public function getCachet(): ?string
    {
        return $this->cachet;
    }

    public function setCachet(?string $cachet): self
    {
        $this->cachet = $cachet;

        return $this;
    }

    /**
     * @return Collection<int, Ligne>
     */
    public function getLignes(): Collection
    {
        return $this->lignes;
    }

    public function addLigne(Ligne $ligne): self
    {
        if (!$this->lignes->contains($ligne)) {
            $this->lignes[] = $ligne;
            $ligne->setCappfpmp($this);
        }

        return $this;
    }

    public function removeLigne(Ligne $ligne): self
    {
        if ($this->lignes->removeElement($ligne)) {
            // set the owning side to null (unless already changed)
            if ($ligne->getCappfpmp() === $this) {
                $ligne->setCappfpmp(null);
            }
        }

        return $this;
    }
}
