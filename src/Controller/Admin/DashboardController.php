<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Projet;
use App\Entity\Contact;
use App\Entity\Mission;
use App\Entity\Freelance;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var UserRepository
     */
    protected UserRepository $userRepository;


    public function __construct(
           private AdminUrlGenerator $adminUrlGenerator,
            UserRepository $userRepository

    ){    
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
       
        return $this->redirect($url);

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->displayUserName(true)
            ->displayUserAvatar(true)
            ->setGravatarEmail($user->getUserIdentifier())
            ->addMenuItems([
                //MenuItem::linkToLogout('Logout', 'fa fa-sign-out'),
            ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Lunari');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Home', 'fa fa-home', "https://lunari.ch/");

        yield MenuItem::section('Utilisateurs')
        ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class)
        ->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Freelance')
        ->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Freelance', 'fas fa-building', Freelance::class)
        ->setPermission('ROLE_ADMIN');

        yield MenuItem::section('Client');
        yield MenuItem::subMenu('Client', 'fas fa-users')->setSubItems([
            MenuItem::linkToCrud("Liste des clients", null, Client::class),
            MenuItem::linkToCrud("Ajouter un client", null, Client::class)->setAction('new')
        ]);

        yield MenuItem::section('Portfolio');
        yield MenuItem::subMenu('Projet vidéo', 'fa-regular fa-circle-play',)->setSubItems([
            MenuItem::linkToCrud("Liste des projets vidéos", null, Projet::class),
            MenuItem::linkToCrud("Ajouter un projet vidéo", null, Projet::class)->setAction('new')
        ]);

        yield MenuItem::section('Mission');
        yield MenuItem::subMenu('Mission', 'far fa-sticky-note',)->setSubItems([
            MenuItem::linkToCrud("Liste des missions", null, Mission::class),
            MenuItem::linkToCrud("Ajouter un article", null, Mission::class)->setAction('new')
        ]);

        yield MenuItem::section('Contact');
        yield MenuItem::subMenu('Contact', 'fas fa-inbox',)->setSubItems([
            MenuItem::linkToCrud("Liste des messages", null, Contact::class),
            // MenuItem::linkToCrud("Ajouter un article", null, Contact::class)->setAction('new')
        ]);

        // yield MenuItem::linkToCrud('Missions', 'fas fa-book', Mission::class)
        // ->setPermission('ROLE_FREELANCE');
        
        // yield MenuItem::linkToCrud('Mes missions', 'fas fa-book', Mission::class)
        // ->setPermission('ROLE_FREELANCE');
    }
}
