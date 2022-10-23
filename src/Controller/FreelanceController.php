<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Repository\MissionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class FreelanceController extends AbstractController
{
    #[Route('/freelance', name: 'freelance')]
    public function index(
        UserInterface $user,
        MissionRepository $missionRepository
    ): Response
    {

        $user = $user->getId();

        return $this->render('freelance/index.html.twig', [
            'missions' => $missionRepository->findByUser($user),
        ]);
    }
}
