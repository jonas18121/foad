<?php

namespace App\Form;

use App\Entity\ClasseDEcole;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ClasseDEcoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('moyenneClasse')
            ->add('numeroClasse', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'numéro de la classe'
                ]
            ])
            // ->add('nbEleves')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ClasseDEcole::class,
        ]);
    }
}
