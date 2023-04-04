<?php

namespace App\Form;

use App\Entity\Moteur;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MoteurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add('marque')
            ->add('modele')
            ->add('puissance',
                IntegerType::class,[
                    'attr' => ['placeholder' => 'Puissance en CV'],
                ])
            ->add('numSerie')
            ->add('anneeAchat')
            ->add('typeMoteur',
                ChoiceType::class,[
                    'choices' => [
                        'fixe' => 'in board',
                        'hors-bord' => 'hors-bord'
                    ]
                ])
            ->add('transmission',
                ChoiceType::class,[
                    'choices' => [
                        'Arbre' => 'Arbre',
                        'Embase' => 'Embase',
                        'IPS' => 'IPS',
                        'Z drive' => 'Z drive']
                ])
            ->add('carburant',
                ChoiceType::class,[
                    'choices' => [
                        'Super' => 'Super',
                        'Super sans plomb' => 'Super sans plomb',
                        'Diesel' => 'Diesel',
                        'Mélange 2 temps' => 'Mélange 2 temps'
                    ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Moteur::class,
        ]);
    }
}
