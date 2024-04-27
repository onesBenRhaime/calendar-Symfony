<?php

namespace App\Form;

use App\Entity\Tache;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Projet;


class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('projet', EntityType::class, [
                'class' => Projet::class,
                'choice_label' => 'nom', // Ou tout autre champ de Projet que vous souhaitez afficher comme label
            
            ])
        
            ->add('date')
            ->add('priorite', ChoiceType::class, [
                'choices' => [
                    'Normale' => 'normale',
                    'Élevée' => 'elevée',
                    'Faible' => 'faible',
                ],
                ])
                
            ->add('statut' ,ChoiceType::class, [
                'choices' => [
                    'A faire' => 'a faire',
                    'Complet' => 'complet',
                   
                ],
                ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
            // Configure your form options here
        ]);
    }
}
