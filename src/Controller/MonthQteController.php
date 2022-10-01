<?php

namespace App\Controller;

use App\Repository\ColisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MonthQteController extends AbstractController
{
    public function __construct(
        private ColisRepository $repo,
    ){}
    public function __invoke(Request $request): int
    {
        $idUser = $request->query->get('id');
        $year = $request->query->get('year');
        $month = $request->query->get('month');
        return $this->repo->countColisByUser($idUser,"id",$year,$month)?: 0;
    }
}
