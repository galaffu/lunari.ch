<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;


class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
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

    public function configureFields(string $pageName): iterable
    {

        return [
            IdField::new('id'),
            TextField::new('email'),
            ChoiceField::new('roles', 'Roles')
            ->allowMultipleChoices()
            ->autocomplete()
            ->setChoices([  'User' => 'ROLE_USER',
                            'Admin' => 'ROLE_ADMIN',
                            'SuperAdmin' => 'ROLE_SUPER_ADMIN',
                            'Freelance' => 'ROLE_FREELANCE']
                        )            
        ];
    }
    
}
