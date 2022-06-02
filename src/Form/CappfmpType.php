<?php

namespace App\Form;

use App\Entity\Cappfpmp;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CappfmpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero')
            ->add('enseignant')
            ->add('datedebut')
            ->add('datefin')
            ->add('absences')
            ->add('cachet')
            ->add('etudiant')
            ->add('tuteur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cappfpmp::class,
        ]);
    }
}
