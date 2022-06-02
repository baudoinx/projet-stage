<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('prenom')
            ->add('classe',  ChoiceType::class, [
                'choices'  => [
                    'Seconde' => "Seconde",
                    'Premier' => "Premiere",
                    'Terminale' => "Terminale"
                ],
            ])
            ->add('promotion')
            ->add('Specialite',  ChoiceType::class, [
                'choices'  => [
                    'Cuisine' => "Cuisine",
                    'CSHCR' => "CSHCR",
                    'CSR' => "CSR",
                    '/'  =>"/"
                ],
            ])
            ->add('Formation',  ChoiceType::class, [
                'choices'  => [
                    'CAP' => "CAP",
                    'BACPRO' => "BAC PRO"
                    
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
