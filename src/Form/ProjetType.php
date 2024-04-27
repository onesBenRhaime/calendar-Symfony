<?php

namespace App\Form;

use App\Entity\Projet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;



class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom')
        ->add('progression', ChoiceType::class, [
            'choices' => [
                'Moyenne' => 'Moyenne',
                'Faible' => 'Faible',
                'Terminé' => 'Termine',
            ],
        ])

        ->add('date_debut')
        ->add('date_fin')
        ->add('priorite', ChoiceType::class, [
            'choices' => [
                'Normale' => 'normale',
                'Élevée' => 'elevée',
                'Faible' => 'faible',
            ]
        ])
        ->add('image', FileType::class, [
            'label' => 'Image',
            'mapped' => false,
            'required' => false,
            'constraints' => [
                new File([
                    'maxSize' => '1024k',
                    'mimeTypes' => [
                        'image/jpeg',
                        'image/png',
                    ],
                    'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG)',
                ]),
            ],
        ]);
        
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
            // Configure your form options here
        ]);
    }
}
