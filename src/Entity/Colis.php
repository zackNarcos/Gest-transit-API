<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\ColisController;
use App\Controller\ColisEntrantController;
use App\Controller\EtatMailerController;
use App\Controller\ImageController;
use App\Controller\MeController;
use App\Controller\MesColisController;
use App\Controller\MonthAvancesController;
use App\Controller\MonthGainsController;
use App\Controller\MonthQteController;
use App\Controller\MonthReliquatsController;
use App\Controller\StatsController;
use App\Repository\ColisRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColisRepository::class)]
#[ApiResource(
    collectionOperations:[
        'get',
        'post',
        'getColisIn' => [
            'method' => 'get',
            'path' => '/getcolis/in',
            'controller' => ColisEntrantController::class,
            'read' => false,
            'pagination_enabled' => true,
            'paginationItemsPerPage' => 3,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => 'affichage de colis pour la destination de l\'user connecté',
            ]
        ],
        'getColis' => [
            'method' => 'get',
            'path' => '/getcolis/me',
            'controller' => ColisController::class,
            'read' => false,
            'pagination_enabled' => true,
            'paginationItemsPerPage' => 3,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => 'affichage de colis pour la destination de l\'user connecté',
            ]
        ],
        'getColisByUser' => [
            'method' => 'get',
            'path' => '/getcolis',
            'controller' => MesColisController::class,
            'read' => false,
            'pagination_enabled' => true,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => 'affichage de colis de l\'user connecté',
            ]
        ],
    ],
    itemOperations:[
        'get',
        'put',
        "delete",
        'patch',
        'stats' => [
            'pagination_enabled' => false,
            'path' => '/statistiques',
            'method' => 'get',
            'controller' => StatsController::class,
            'read' => false,
            'openapi_context' => [
                'tags' => ['Statistiques'],
            ]
        ],
        'mailer' => [
            'pagination_enabled' => false,
            'path' => '/mailer',
            'method' => 'get',
            'controller' => EtatMailerController::class,
            'read' => false,
            'openapi_context' => [
                'tags' => ['service'],
            ]
        ],
        'sumAvances' => [
            'method' => 'get',
            'path' => '/sum/avances',
            'controller' => MonthAvancesController::class,
            'read' => false,
            'pagination_enabled' => false,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => 'Somme des avances recue par mois, en recevant l\'id de l\'employe en parametre',
            ]

        ],
        'countColis' => [
            'method' => 'get',
            'path' => '/count/colis',
            'controller' => MonthQteController::class,
            'read' => false,
            'pagination_enabled' => false,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => ' qte recue par mois, en recevant l\'id de l\'employe en parametre',
            ]

        ],
        'sumGains' => [
            'method' => 'get',
            'path' => '/sum/gains',
            'controller' => MonthGainsController::class,
            'read' => false,
            'pagination_enabled' => false,
            'openapi_context' => [
                'tags' => ['service'],
                'summary' => 'Somme des gains recue par mois, en recevant l\'id de l\'employe en parametre',
            ]
        ],
    ]
)]
#[ApiFilter(SearchFilter::class, properties: [
    'nomExpediteur' => 'word_start',
    'numero' => 'start'
])]
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
    private ?int $poids = null;

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

    #[ORM\Column(nullable: true)]
    private ?int $avance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDepot = null;

    #[ORM\ManyToOne(inversedBy: 'colis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $employe = null;

    #[ORM\Column]
    private ?bool $isSolde = null;

    #[ORM\Column(nullable: true)]
    private ?int $reste = null;

    #[ORM\OneToOne(mappedBy: 'coli')]
    private ?Reliquat $reliquat = null;

    #[ORM\ManyToOne(inversedBy: 'colis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pays $paysDestination = null;

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

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): self
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

    public function getAvance(): ?int
    {
        return $this->avance;
    }

    public function setAvance(?int $avance): self
    {
        $this->avance = $avance;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

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

    public function isIsSolde(): ?bool
    {
        return $this->isSolde;
    }

    public function setIsSolde(bool $isSolde): self
    {
        $this->isSolde = $isSolde;

        return $this;
    }

    public function getReste(): ?int
    {
        return $this->reste;
    }

    public function setReste(?int $reste): self
    {
        $this->reste = $reste;

        return $this;
    }

    public function getReliquat(): ?Reliquat
    {
        return $this->reliquat;
    }

    public function setReliquat(?Reliquat $reliquat): self
    {
        // unset the owning side of the relation if necessary
        if ($reliquat === null && $this->reliquat !== null) {
            $this->reliquat->setColi(null);
        }

        // set the owning side of the relation if necessary
        if ($reliquat !== null && $reliquat->getColi() !== $this) {
            $reliquat->setColi($this);
        }

        $this->reliquat = $reliquat;

        return $this;
    }

    public function getPaysDestination(): ?Pays
    {
        return $this->paysDestination;
    }

    public function setPaysDestination(?Pays $paysDestination): self
    {
        $this->paysDestination = $paysDestination;

        return $this;
    }
}
