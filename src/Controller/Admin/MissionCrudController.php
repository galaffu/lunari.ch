<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Client;
use App\Entity\Mission;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MissionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mission::class;
    }

    // public function configureActions(Actions $actions): Actions
    // {
    //     return $actions
    //         // ...
    //         // this will forbid to create or delete entities in the backend
    //         ->disable(Action::NEW, Action::DELETE)
    //     ;
    // }

    public function configureActions(Actions $actions): Actions
    {

        $viewMission = Action::new('View mission', 'fas fa-file-invoice')
        ->displayIf(static function ($user) {
            return $user->getMissions();
        });

        return $actions
            // ...
            ->setPermission(Action::NEW, 'ROLE_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new('id'),
            yield TextField::new('lieu'),
            yield DateTimeField::new('dateDebut'),
            yield DateTimeField::new('dateFin'),
            yield AssociationField::new('user')->setCrudController(User::class),
            yield AssociationField::new('client')->setCrudController(Client::class),
            // TextEditorField::new('description'),
        ];
    }
    
}
