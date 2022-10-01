<?php

namespace App\Controller;

use App\Repository\ColisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class StatsController extends AbstractController
{

    public function __construct(

    )
    {
    }

    public function __invoke( ColisRepository $colisRepository)
    {
        $beneficeByDay = $colisRepository->somColisByDay();
        $beneficeReelByDay = $colisRepository->somReelColisByDay();
        $colisByDay = $colisRepository->countColisByDay();
        $usersStats = $colisRepository->getUserStatByYear();
        return $this->json([
            "dayBeneficePrevus" => $beneficeByDay?: 0,
            "dayBeneficeReel" => $beneficeReelByDay?: 0,
            "colisByDay" => $colisByDay?: 0,
            "usersStats" => $usersStats,
            "colisByYear" => [
                $colisRepository->SomComByYear(1)?: 0,
                $colisRepository->SomComByYear(2)?: 0,
                $colisRepository->SomComByYear(3)?: 0,
                $colisRepository->SomComByYear(4)?: 0,
                $colisRepository->SomComByYear(5)?: 0,
                $colisRepository->SomComByYear(6)?: 0,
                $colisRepository->SomComByYear(7)?: 0,
                $colisRepository->SomComByYear(8)?: 0,
                $colisRepository->SomComByYear(9)?: 0,
                $colisRepository->SomComByYear(10)?: 0,
                $colisRepository->SomComByYear(11)?: 0,
                $colisRepository->SomComByYear(12)?: 0,
            ],
        ]);
    }

}
