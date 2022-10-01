<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\ColisRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class HashPasswordController extends AbstractController
{
    private $encoder;

    public function  __construct(UserPasswordHasherInterface $encoder){
        $this->encoder=$encoder;
    }
    public function __invoke(Request $request): string
    {
        $user = new User();
        $plainPassword = $request->query->get('string');
        return $this->encoder->hashPassword($user, $plainPassword);
    }
}
