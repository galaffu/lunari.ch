<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use App\Repository\VideoMiseEnAvantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PortfolioController extends AbstractController
{

    public function __construct(ProjetRepository $repository, EntityManagerInterface $em)
    {

        $this->repository = $repository;
        $this->em = $em;

    }
    /**
     * @Route("/portfolio", name="portfolio")
     */
    public function index(
            ProjetRepository $projetRepository,
            PaginatorInterface $paginator,
            VideoMiseEnAvantRepository $videoMiseEnAvantRepository,
            Request $request
        ): Response {

            $data = $projetRepository->findAll();
            $unique = $videoMiseEnAvantRepository->findOneBy(array(),array('id'=>'DESC'),1,0);

        $projets = $paginator->paginate(
            $data,
           $request->query->getInt('page', 1), 
            6
        );
        return $this->render('portfolio/index.html.twig', [
            'projets' => $projets,
            'unique' => $unique,
        ]);
    }
}

