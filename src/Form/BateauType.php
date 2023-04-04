<?php

namespace App\Form;

use App\Entity\Bateau;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BateauType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add(
                'longueur',
                NumberType::class,
                [
                    'label' => 'Longueur:',
                    'attr' => ['placeholder' => 'Longueur en mètres, centimètres'],
                    'required' => false,

                ]
            )
            ->add(
                'largeur',
                NumberType::class,
                [
                    'label' => 'Largeur:',
                    'attr' => ['placeholder' => 'Largeur en mètres, centimètres'],
                    'required' => false,

                ]
            )
            ->add(
                'poids',
                IntegerType::class,
                [
                    'label' => 'Poids:',
                    'attr' => ['placeholder' => 'Poids en kilogrammes'],
                    'required' => false,
                ]
            )
            ->add(
                'tirantdeau',
                NumberType::class,
                [
                    'label' => 'Tirant d\'eau:',
                    'attr' => ['placeholder' => 'Profondeur en en mètres, centimètres'],
                    'required' => false,
                ]
            )
            ->add(
                'tirantDAir',
                NumberType::class,
                [
                    'label' => 'Tirant d\'air:',
                    'attr' => ['placeholder' => 'Hauteur en mètres, centimètres'],
                    'required' => false,
                ]

            )
            ->add(
                'type',
                ChoiceType::class,
                [
                    'choices' => [
                        'Voilier' => 'Voilier',
                        'Bateau à moteur' => 'Bateau à moteur',
                    ],
                    'required' => false,
                ]
            )
            ->add('constructeur')
            ->add('modele')
            ->add(
                'anneeConstruction',
                IntegerType::class,
                [
                    'label' => 'Année de construction:',
                    'attr' => ['placeholder' => 'Année format AAAA'],
                    'required' => false,
                ]

            )
            ->add(
                'categorieConception',
                ChoiceType::class,
                [
                    'choices' => [
                        'A, force 9 etabli max 47 nds, Vagues max 10 m' => 'A',
                        'B, force 9 etabli max 40 nds, Vagues max 8 m' => 'B',
                        'C, force 9 etabli max 27 nds, Vagues max 4 m' => 'C',
                        'D, force 9 etabli max 16 nds, Vagues max 0.5 m' => 'D',
                    ],
                    'required' => false,
                ]
            )

            ->add(
                'typeNavigation',
                ChoiceType::class,
                [
                    'choices' => [
                        'Côtière, Jusqu’à 6 milles d’un abri ' => 'nav-cotière',
                        'Semi-hauturière, entre 6 et 60 milles d’un abri' => 'semi-hauturière',
                        'Hauturière, Au-delà de 40 milles d’un abri ' => 'hauturière',

                ],
                    'required' => false,
                    ]
            )
            ->add(
                'fuel',
                IntegerType::class,
                [
                    'label' => 'Carburant:',
                    'attr' => ['placeholder' => 'Contenance en litres'],
                    'required' => false,
                ]
            )
            ->add(
                'eau',
                IntegerType::class,
                [
                    'label' => 'Eau douce:',
                    'attr' => ['placeholder' => 'Contenance en litres'],
                    'required' => false,
                ]

            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Bateau::class,
            ]
        );
    }
}
