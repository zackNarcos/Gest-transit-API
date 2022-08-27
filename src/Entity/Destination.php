<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\DestinationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinationRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['libelle' => 'exact'])]
class Destination
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $prixKilos = null;

    #[ORM\Column(nullable: true)]
    private ?int $prixDouane = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $jourDeDepart = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isArchivate = null;

    #[ORM\OneToMany(mappedBy: 'destination', targetEntity: Colis::class)]
    private Collection $colis;

    public function __construct()
    {
        $this->colis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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

    public function getJourDeDepart(): ?string
    {
        return $this->jourDeDepart;
    }

    public function setJourDeDepart(?string $jourDeDepart): self
    {
        $this->jourDeDepart = $jourDeDepart;

        return $this;
    }

    public function isIsArchivate(): ?bool
    {
        return $this->isArchivate;
    }

    public function setIsArchivate(?bool $isArchivate): self
    {
        $this->isArchivate = $isArchivate;

        return $this;
    }

    /**
     * @return Collection<int, Colis>
     */
    public function getColis(): Collection
    {
        return $this->colis;
    }

    public function addColi(Colis $coli): self
    {
        if (!$this->colis->contains($coli)) {
            $this->colis->add($coli);
            $coli->setDestination($this);
        }

        return $this;
    }

    public function removeColi(Colis $coli): self
    {
        if ($this->colis->removeElement($coli)) {
            // set the owning side to null (unless already changed)
            if ($coli->getDestination() === $this) {
                $coli->setDestination(null);
            }
        }

        return $this;
    }
}
