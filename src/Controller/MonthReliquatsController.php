<?php

namespace App\Controller;

use App\Repository\ColisRepository;
use App\Repository\ReliquatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MonthReliquatsController extends AbstractController
{
    public function __construct(
        private ReliquatRepository $repo,
    ){}
    public function __invoke(Request $request): int
    {
        $idUser = $request->query->get('id');
        $year = $request->query->get('year');
        $month = $request->query->get('month');
        return $this->repo->countByUser($idUser,"montant",$year,$month)?: 0;
    }
}
