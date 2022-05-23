<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntrepriseRepository::class)
 */
class Entreprise
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $SIREN;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cachet;

    /**
     * @ORM\OneToMany(targetEntity=Tuteur::class, mappedBy="entreprise")
     */
    private $tuteurs;

    /**
     * @ORM\OneToMany(targetEntity=Pfmp::class, mappedBy="entreprise")
     */
    private $pfmps;

    public function __construct()
    {
        $this->tuteurs = new ArrayCollection();
        $this->pfmps = new ArrayCollection();
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

    public function getSIREN(): ?string
    {
        return $this->SIREN;
    }

    public function setSIREN(string $SIREN): self
    {
        $this->SIREN = $SIREN;

        return $this;
    }

    public function getCachet(): ?string
    {
        return $this->cachet;
    }

    public function setCachet(string $cachet): self
    {
        $this->cachet = $cachet;

        return $this;
    }

    /**
     * @return Collection<int, Tuteur>
     */
    public function getTuteurs(): Collection
    {
        return $this->tuteurs;
    }

    public function addTuteur(Tuteur $tuteur): self
    {
        if (!$this->tuteurs->contains($tuteur)) {
            $this->tuteurs[] = $tuteur;
            $tuteur->setEntreprise($this);
        }

        return $this;
    }

    public function removeTuteur(Tuteur $tuteur): self
    {
        if ($this->tuteurs->removeElement($tuteur)) {
            // set the owning side to null (unless already changed)
            if ($tuteur->getEntreprise() === $this) {
                $tuteur->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Pfmp>
     */
    public function getPfmps(): Collection
    {
        return $this->pfmps;
    }

    public function addPfmp(Pfmp $pfmp): self
    {
        if (!$this->pfmps->contains($pfmp)) {
            $this->pfmps[] = $pfmp;
            $pfmp->setEntreprise($this);
        }

        return $this;
    }

    public function removePfmp(Pfmp $pfmp): self
    {
        if ($this->pfmps->removeElement($pfmp)) {
            // set the owning side to null (unless already changed)
            if ($pfmp->getEntreprise() === $this) {
                $pfmp->setEntreprise(null);
            }
        }

        return $this;
    }
}
