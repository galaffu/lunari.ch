<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use App\Repository\BlogpostRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(
        Request $request
        ): Response

    {

        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('home')];
        $urls[] = ['loc' => $this->generateUrl('service')];
        $urls[] = ['loc' => $this->generateUrl('portfolio')];
        $urls[] = ['loc' => $this->generateUrl('app_immersion')];
        $urls[] = ['loc' => $this->generateUrl('lunix')];
        $urls[] = ['loc' => $this->generateUrl('contact')];

        // dd($urls);

        // foreach ($projetRepository->findAll() as $projet) {

        //     $urls[] = [
        //         'loc' => $this->generateUrl('portfolio_show', ['slug' => $projet->getSlug()])
        //     ];
        // }

        // foreach ($blogpostRepository->findAll() as $blogpost) {
            
        //     $urls[] = [
        //         'loc' => $this->generateUrl('blog_show', ['slug' => $blogpost->getSlug()]),
        //         'lastmod' => $blogpost->getCreatedAt()->format('Y-m-d')
        //     ];
        // }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname,
            ]),
            200
        );

        $response->headers->set('Content-type', 'text/xml');


        return $response;
    }
}
