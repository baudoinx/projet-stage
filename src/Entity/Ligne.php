<?php

namespace App\Entity;

use App\Repository\LigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LigneRepository::class)
 */
class Ligne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Competence::class)
     */
    private $competence;

    /**
     * @ORM\OneToMany(targetEntity=Sousligne::class, mappedBy="ligne", cascade={"persist"})
     */
    private $sousligne;

    /**
     * @ORM\ManyToOne(targetEntity=Cappfpmp::class, inversedBy="lignes")
     */
    private $cappfpmp;

    /**
     * @ORM\ManyToOne(targetEntity=Cappfpmp::class, inversedBy="Lignes")
     */
    private $pfmp;

    public function __construct()
    {
        $this->sousligne = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompetence(): ?competence
    {
        return $this->competence;
    }

    public function setCompetence(?competence $competence): self
    {
        $this->competence = $competence;

        return $this;
    }

    /**
     * @return Collection<int, sousligne>
     */
    public function getSousligne(): Collection
    {
        return $this->sousligne;
    }

    public function addSousligne(sousligne $sousligne): self
    {
        if (!$this->sousligne->contains($sousligne)) {
            $this->sousligne[] = $sousligne;
            $sousligne->setLigne($this);
        }

        return $this;
    }

    public function removeSousligne(sousligne $sousligne): self
    {
        if ($this->sousligne->removeElement($sousligne)) {
            // set the owning side to null (unless already changed)
            if ($sousligne->getLigne() === $this) {
                $sousligne->setLigne(null);
            }
        }

        return $this;
    }

    public function getCappfpmp(): ?Cappfpmp
    {
        return $this->cappfpmp;
    }

    public function setCappfpmp(?Cappfpmp $cappfpmp): self
    {
        $this->cappfpmp = $cappfpmp;

        return $this;
    }

    public function getPfmp(): ?Cappfpmp
    {
        return $this->pfmp;
    }

    public function setPfmp(?Cappfpmp $pfmp): self
    {
        $this->pfmp = $pfmp;

        return $this;
    }
}
