<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // yield IdField::new('id'),
            yield TextField::new('nom'),
            yield ImageField::new('Image', 'Logo du client')
            ->setBasePath('/uploads/logo-client')            
            ->setUploadDir('public/uploads/logo-client'),
        ];
    }
    
}
