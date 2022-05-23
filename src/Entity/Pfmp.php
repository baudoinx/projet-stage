<?php

namespace App\Entity;

use App\Repository\PfmpRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PfmpRepository::class)
 */
class Pfmp
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero;

    /**
     * @ORM\ManyToOne(targetEntity=eleve::class, inversedBy="pfmps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Eleve;

    /**
     * @ORM\ManyToOne(targetEntity=utilisateur::class, inversedBy="pfmps")
     */
    private $enseignant;

    /**
     * @ORM\ManyToOne(targetEntity=entreprise::class, inversedBy="pfmps")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprise;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFin;

    /**
     * @ORM\Column(type="integer")
     */
    private $Noter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getEleve(): ?eleve
    {
        return $this->Eleve;
    }

    public function setEleve(?eleve $Eleve): self
    {
        $this->Eleve = $Eleve;

        return $this;
    }

    public function getEnseignant(): ?utilisateur
    {
        return $this->enseignant;
    }

    public function setEnseignant(?utilisateur $enseignant): self
    {
        $this->enseignant = $enseignant;

        return $this;
    }

    public function getEntreprise(): ?entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getNoter(): ?int
    {
        return $this->Noter;
    }

    public function setNoter(int $Noter): self
    {
        $this->Noter = $Noter;

        return $this;
    }
}
