<?php

namespace App\Controller;

use App\Repository\ClientRepository;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
 * @Route("/change_locale/{locale}", name="change_locale")
 */
public function changeLocale($locale, Request $request)
{
    // On stocke la langue dans la session
    $request->getSession()->set('_locale', $locale);

    // On revient sur la page précédente
    return $this->redirect($request->headers->get('referer'));
}


    #[Route('/', name: 'home')]
    public function index(
        ProjetRepository $projetRepository,
        ClientRepository $clientRepository
        ): Response
    {
        return $this->render('home/index.html.twig', [
            'projets' => $projetRepository->lastFour(),
            'clients' => $clientRepository->findAll(),
        ]);
    }

    public function lunabar(): Response
    {
        return $this->render('navbar/lunabar.html.twig', [
        ]);
    }
}
