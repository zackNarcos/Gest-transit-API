<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\EtatMailerController;
use App\Controller\MonthAvancesController;
use App\Controller\MonthGainsController;
use App\Controller\MonthQteController;
use App\Controller\MonthReliquatsController;
use App\Controller\StatsController;
use App\Repository\ReliquatRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
#[ORM\Entity(repositoryClass: ReliquatRepository::class)]
#[ApiResource(
    itemOperations:[
        'get',
        'put',
        "delete",
        'patch',
        'sumReliquats' => [
            'method' => 'get',
            'path' => '/sum/reliquats',
            'controller' => MonthReliquatsController::class,
            'read' => false,
            'pagination_enabled' => false,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => 'Somme des reliquat recue par mois, en recevant l\'id de l\'employe en parametre',
            ]

        ],
    ]
)]
#[ApiFilter(SearchFilter::class, properties: ['coli' => 'exact'])]
class Reliquat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne(inversedBy: 'reliquats')]
    private ?User $employe = null;

    #[ORM\OneToOne(inversedBy: 'reliquat')]
    private ?Colis $coli = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEmploye(): ?User
    {
        return $this->employe;
    }

    public function setEmploye(?User $employe): self
    {
        $this->employe = $employe;

        return $this;
    }

    public function getColi(): ?Colis
    {
        return $this->coli;
    }

    public function setColi(?Colis $coli): self
    {
        $this->coli = $coli;

        return $this;
    }
}
