<?php

namespace App\Form;

use App\Entity\Freelance;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FreelanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',

            ],
            'label' => 'Votre nom',
            'label_attr' => [
                'class' => 'form-label text-white  mt-4',
            ]
        ])
        ->add('prenom', TextType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',

            ],
            'label' => 'Votre prénom',
            'label_attr' => [
                'class' => 'form-label text-white  mt-4',
            ]
        ])
        
        ->add('telephone', NumberType::class, [
            'attr' => [
                'class' => 'form-control',
                'minlenght' => '2',
                'maxlenght' => '50',

            ],
            'label' => 'Votre numéro de téléphone',
            'label_attr' => [
                'class' => 'form-label text-white  mt-4',
            ]
        ])

        ->add('cv', FileType::class, [
            'label' => 'Votre CV (PDF)',
            'label_attr' => [
                'class' => 'form-label text-center text-white mt-2',
            ],
            'mapped' => false, // Tell that there is no Entity to link
            'required' => true,
            'constraints' => [
              new File([ 
                'maxSize' => '4096k',
                'mimeTypes' => [ // We want to let upload only txt, csv or Excel files
                  'text/x-comma-separated-values', 
                  'text/comma-separated-values', 
                  'text/x-csv', 
                  'text/csv', 
                  'text/plain',
                  'application/octet-stream', 
                  'application/vnd.ms-excel', 
                  'application/x-csv', 
                  'application/csv', 
                  'application/excel', 
                  'application/vnd.msexcel', 
                  'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                  'application/pdf',
                  'application/x-pdf',
                ],
                'mimeTypesMessage' => "This document isn't valid.",
              ])
            ],
          ]); 

    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Freelance::class,
        ]);
    }
}
