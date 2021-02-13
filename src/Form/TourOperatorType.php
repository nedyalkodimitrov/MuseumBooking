<?php

namespace App\Form;

use App\Entity\TourOperator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TourOperatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fName')
            ->add('phoneNumber')
//            ->add('visitRating')
//            ->add('image')
//            ->add('user')
            ->add('city')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TourOperator::class,
        ]);
    }
}
