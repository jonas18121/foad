<?php

namespace App\Form;

use App\Entity\Didding;
use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class DiddingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('priceStart', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Prix de départ'
                ]
            ])
            ->add('priceImmediate', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Prix immédiat'
                ]
            ])
            ->add('dateStartAt', DateType::class, [
                'attr' => [
                    'placeholder' => 'Date de départ'
                ]
            ])
            ->add('dateEndAt', DateType::class, [
                'attr' => [
                    'placeholder' => 'Date de fin'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Didding::class,
        ]);
    }
}
