<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ColisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRepository::class)]
#[ApiResource]
#[ApiFilter(SearchFilter::class, properties: ['numero' => 'exact'])]
class Colis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomExpediteur = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomExpediteur = null;

    #[ORM\Column(length: 255)]
    private ?string $telephoneExpediteur = null;

    #[ORM\Column(length: 255)]
    private ?string $npiExpediteur = null;

    #[ORM\Column(length: 255)]
    private ?string $emailExpediteur = null;

    #[ORM\Column(length: 255)]
    private ?string $nomBeneficiaire = null;

    #[ORM\Column(length: 255)]
    private ?string $prenomBeneficiaire = null;

    #[ORM\Column(length: 255)]
    private ?string $telephoneBeneficiaire = null;

    #[ORM\Column]
    private ?float $poids = null;

    #[ORM\Column(nullable: true)]
    private ?int $emballage = null;

    #[ORM\Column(nullable: true)]
    private ?int $douane = null;

    #[ORM\Column(length: 255)]
    private ?string $contenue = null;

    #[ORM\Column]
    private ?int $valeur = null;

    #[ORM\Column]
    private ?int $prixKilo = null;

    #[ORM\Column]
    private ?int $prixTotal = null;

    #[ORM\ManyToOne(inversedBy: 'colis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Destination $destination = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    private ?string $numero = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomExpediteur(): ?string
    {
        return $this->nomExpediteur;
    }

    public function setNomExpediteur(string $nomExpediteur): self
    {
        $this->nomExpediteur = $nomExpediteur;

        return $this;
    }

    public function getPrenomExpediteur(): ?string
    {
        return $this->prenomExpediteur;
    }

    public function setPrenomExpediteur(string $prenomExpediteur): self
    {
        $this->prenomExpediteur = $prenomExpediteur;

        return $this;
    }

    public function getTelephoneExpediteur(): ?string
    {
        return $this->telephoneExpediteur;
    }

    public function setTelephoneExpediteur(string $telephoneExpediteur): self
    {
        $this->telephoneExpediteur = $telephoneExpediteur;

        return $this;
    }

    public function getNpiExpediteur(): ?string
    {
        return $this->npiExpediteur;
    }

    public function setNpiExpediteur(string $npiExpediteur): self
    {
        $this->npiExpediteur = $npiExpediteur;

        return $this;
    }

    public function getEmailExpediteur(): ?string
    {
        return $this->emailExpediteur;
    }

    public function setEmailExpediteur(string $emailExpediteur): self
    {
        $this->emailExpediteur = $emailExpediteur;

        return $this;
    }

    public function getNomBeneficiaire(): ?string
    {
        return $this->nomBeneficiaire;
    }

    public function setNomBeneficiaire(string $nomBeneficiaire): self
    {
        $this->nomBeneficiaire = $nomBeneficiaire;

        return $this;
    }

    public function getPrenomBeneficiaire(): ?string
    {
        return $this->prenomBeneficiaire;
    }

    public function setPrenomBeneficiaire(string $prenomBeneficiaire): self
    {
        $this->prenomBeneficiaire = $prenomBeneficiaire;

        return $this;
    }

    public function getTelephoneBeneficiaire(): ?string
    {
        return $this->telephoneBeneficiaire;
    }

    public function setTelephoneBeneficiaire(string $telephoneBeneficiaire): self
    {
        $this->telephoneBeneficiaire = $telephoneBeneficiaire;

        return $this;
    }

    public function getPoids(): ?float
    {
        return $this->poids;
    }

    public function setPoids(float $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getEmballage(): ?int
    {
        return $this->emballage;
    }

    public function setEmballage(?int $emballage): self
    {
        $this->emballage = $emballage;

        return $this;
    }

    public function getDouane(): ?int
    {
        return $this->douane;
    }

    public function setDouane(?int $douane): self
    {
        $this->douane = $douane;

        return $this;
    }

    public function getContenue(): ?string
    {
        return $this->contenue;
    }

    public function setContenue(string $contenue): self
    {
        $this->contenue = $contenue;

        return $this;
    }

    public function getValeur(): ?int
    {
        return $this->valeur;
    }

    public function setValeur(int $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getPrixKilo(): ?int
    {
        return $this->prixKilo;
    }

    public function setPrixKilo(int $prixKilo): self
    {
        $this->prixKilo = $prixKilo;

        return $this;
    }

    public function getPrixTotal(): ?int
    {
        return $this->prixTotal;
    }

    public function setPrixTotal(int $prixTotal): self
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
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
}
