<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre de l\'annonce'
                ]
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Contenu de l\'annonce'
                ]
            ])

            // ->add('createdAt', DateTimeType::class)

            ->add('priceStart', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Prix de départ'
                ],
                'required' => false
            ])
            ->add('priceEnd', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Prix de fin'
                ],
                'required' => false
            ])
            
            ->add('priceImmediate', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Prix fixe immediat'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
