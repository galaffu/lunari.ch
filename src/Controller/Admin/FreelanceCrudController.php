<?php

namespace App\Controller\Admin;

use App\Entity\Freelance;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FreelanceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Freelance::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('telephone'),
            ImageField::new('cv', 'Your PDF')
                    ->setFormType(FileUploadType::class)
                    ->setBasePath('public/files/freelance/cv') //see documentation about ImageField to understand the difference beetwen setBasePath and setUploadDir
                    ->setUploadDir('public/files/freelance/cv')
                    ->setColumns(6)
                    ->hideOnIndex()
                    ->setFormTypeOptions(['attr' => [
                            'accept' => 'application/pdf'
                        ]
                    ]),
        TextField::new('cv')->setTemplatePath('admin/fields/document_link.html.twig')->onlyOnIndex(),
        
    ];
}}
