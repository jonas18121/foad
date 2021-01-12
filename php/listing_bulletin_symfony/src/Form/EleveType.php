<?php

namespace App\Form;

use App\Entity\Eleve;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class EleveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Le nom de l\'élève'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Le prénom de l\'élève'
                ]
            ])
            ->add('dateNaissanceAt', BirthdayType::class, [
                'attr' => [
                    'placeholder' => 'La date de naissance de l\'élève'
                ]
            ])
            ->add('moyenne', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'La moyenne de l\'élève'
                ]
            ])
            ->add('appreciation', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'L\'appréciation de l\'élève'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Eleve::class,
        ]);
    }
}
