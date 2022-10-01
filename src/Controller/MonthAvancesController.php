<?php

namespace App\Controller;

use App\Repository\ColisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MonthAvancesController extends AbstractController
{
    public function __construct(
        private ColisRepository $repo,
    ){}
    public function __invoke(Request $request): int
    {
        $idUser = $request->query->get('id');
        $year = $request->query->get('year');
        $month = $request->query->get('month');
        return $this->repo->countByUser($idUser,"avance",$year,$month)?: 0;
    }
}
