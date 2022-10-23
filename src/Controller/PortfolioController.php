<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio', name: 'portfolio')]
    public function index(        
        ProjetRepository $projetRepository
    ): Response
    {
        return $this->render('portfolio/index.html.twig', [
            'projets' => $projetRepository->findAll(),
        ]);
    }
}
