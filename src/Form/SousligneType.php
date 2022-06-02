<?php

namespace App\Form;

use App\Entity\Sousligne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SousligneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note',ChoiceType::class, [
                'choices'  => [
                    'Maitrise Insuffisante' =>"MI" ,
                    'Maitrise Faible' =>"MF" ,
                    'Maitrise Uuffisante' =>"MS" ,
                    'Tres bonne maitrise' => "TBM"
                ],
                'expanded' => true,
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
