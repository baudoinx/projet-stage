<?php

namespace App\Form;

use App\Entity\Eleve;
use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\EntityRepository;
use Doctrine\ORM\QueryBuilder;
class AffecterenseigantType extends AbstractType  
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Enseignant', EntityType::class,
            [
                'class' => Utilisateur::class,
                'query_builder' => function (UtilisateurRepository $er) {
                    $enseignant="Enseignant";
                    return $er->createQueryBuilder('u')
                        ->where('u.type = :Enseignant')
                        ->setParameter('Enseignant', $enseignant) 
                        ->orderBy('u.Nom', 'ASC')
                        ;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class
        ]);
    }
}
