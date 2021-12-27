<?php

namespace App\Entity;

use App\Repository\DepotRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepotRepository::class)
 */
class Depot
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
    private $lien_de_travail;

    /**
     * @ORM\ManyToOne(targetEntity=Travail::class, inversedBy="depots")
     */
    private $travail;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="depots")
     */
    private $etudiant;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienDeTravail(): ?string
    {
        return $this->lien_de_travail;
    }

    public function setLienDeTravail(?string $lien_de_travail): self
    {
        $this->lien_de_travail = $lien_de_travail;

        return $this;
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

    public function getEtudiant(): ?User
    {
        return $this->etudiant;
    }

    public function setEtudiant(?User $etudiant): self
    {
        $this->etudiant = $etudiant;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }
}
