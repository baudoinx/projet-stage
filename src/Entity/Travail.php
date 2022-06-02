<?php

namespace App\Entity;

use App\Repository\TravailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TravailRepository::class)
 */
class Travail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;


    public function getId(): ?int
    {
        return $this->id;
    }

  
    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $Libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

   
}
