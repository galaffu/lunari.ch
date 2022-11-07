<?php

namespace App\Controller;

use App\Entity\Freelance;
use App\Form\FreelanceType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class RegisterFreelanceController extends AbstractController
{
    #[Route('/register/freelance', name: 'app_register_freelance')]

    public function index(
        Request $request,
        UserInterface $user,
        EntityManagerInterface $manager,
        FileUploader $fileUploader,
        SluggerInterface $slugger
        ): Response
    {

        $freelance = new Freelance();
        $form = $this->createForm(FreelanceType::class, $freelance);
        $form->handleRequest($request);
        $user = $this->getUser();
        $freelance->setUser($user);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $brochureFile */
            $cvFile = $form->get('cv')->getData();
            if ($cvFile) {
                $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$cvFile->guessExtension();

                try {
                    $cvFile->move(
                        $this->getParameter('freelance_cv'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $freelance->setCv($newFilename);
                $manager->persist($freelance);
                $manager->flush();
                return $this->redirectToRoute('home');
            }
            
            // $cvFile = $form->get('cv')->getData();
            // $originalFilename = pathinfo($cvFile->getClientOriginalName(), PATHINFO_FILENAME);
            // // this is needed to safely include the file name as part of the URL
            // $cvFile->move(
            //     $this->getParameter('freelance_cv'),
            //     $originalFilename
            // );

            // $freelance->setCv($originalFilename);
            // $manager->persist($freelance);
            // $manager->flush();

            // return $this->redirectToRoute('register_freelance', array('id' => $freelance->getId()));

        }

        return $this->render('register_freelance/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    }

