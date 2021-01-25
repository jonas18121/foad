<?php

namespace App\Form;

use App\Entity\Didding;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class PriceShopperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /* ->add('priceStart')
            ->add('priceEnd')
            ->add('priceImmediate') */
            ->add('priceShopper', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Miser un prix'
                ]
            ])
            /* ->add('dateStartAt')
            ->add('dateEndAt')
            ->add('createdAt')
            ->add('isActive')
            ->add('product')* /
            ->add('shopper') */
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Didding::class,
        ]);
    }
}
