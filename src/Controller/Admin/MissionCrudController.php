<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Client;
use App\Entity\Mission;
use Doctrine\DBAL\Schema\View;
use App\Repository\MissionRepository;
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
        return $actions
            // ...
            ->setPermission(Action::NEW, 'ROLE_FREELANCE')
            ->setPermission(Action::DELETE, 'ROLE_FREELANCE')
            ->setPermission(Action::INDEX, 'ROLE_FREELANCE')
        ;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [

        //     AssociationField::new('mission')
        //     ->setRequired(true)
        //     ->setFormTypeOptions(['query_builder' => function (MissionRepository $em) {
        //     return $em->createQueryBuilder('f')
        //         ->where('f.user = :user')
        //         ->orderBy('f.mission', 'ASC')
        //         ->setParameter('user', $this->getUser())
        //         ;
        // }]),


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
