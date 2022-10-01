<?php

namespace App\Controller;

use App\Repository\ColisRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class MesColisController extends AbstractController
{
    public function __construct(
        private ColisRepository $repo,
    ){}
    public function __invoke(Request $request): array
    {
        $idUser = $request->query->get('id');
        $year = $request->query->get('year');
        $month = $request->query->get('month');
        $day = $request->query->get('day');
        return $this->repo->findColisByUser($idUser,$year, $month, $day);
    }
}
