<?php

namespace App\Entity;

use App\Repository\PaysRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaysRepository::class)]
class Pays
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $prixKilos = null;

    #[ORM\Column(nullable: true)]
    private ?int $prixDouane = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrixKilos(): ?int
    {
        return $this->prixKilos;
    }

    public function setPrixKilos(int $prixKilos): self
    {
        $this->prixKilos = $prixKilos;

        return $this;
    }

    public function getPrixDouane(): ?int
    {
        return $this->prixDouane;
    }

    public function setPrixDouane(?int $prixDouane): self
    {
        $this->prixDouane = $prixDouane;

        return $this;
    }
}
