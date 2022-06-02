<?php

namespace App\Entity;

use App\Repository\SousligneRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SousligneRepository::class)
 */
class Sousligne
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Travail::class)
     */
    private $travail;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity=Ligne::class, inversedBy="sousligne")
     */
    private $ligne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTravail(): ?Travail
    {
        return $this->travail;
    }

    public function setTravail(?Travail $travail): self
    {
        $this->travail = $travail;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getLigne(): ?Ligne
    {
        return $this->ligne;
    }

    public function setLigne(?Ligne $ligne): self
    {
        $this->ligne = $ligne;

        return $this;
    }
}
