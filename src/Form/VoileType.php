<?php

namespace App\Form;

use App\Entity\Voile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('denomination', TextType::class)
            ->add(
                'surface',
                NumberType::class,
                [
                    'label' => 'Surface',
                    'attr' => [
                        'placeholder' => 'Surface en mètres,centimetres carrés',
                    ],
                    'required' => false,
                ]
            )
            ->add(
                'anneeFabrication',
                IntegerType::class,
                [
                    'label' => 'Année de fabrication:',
                    'attr' => ['placeholder' => 'Année au format AAAA'],
                    'required' => false,
                ]
            )
            ->add(
                'longueurGuindant',
                NumberType::class,
                [
                    'label' => 'Longueur du quindant:',
                    'attr' => [
                        'placeholder' => 'En mètres, centimètres',

                    ],
                    'required' => false,
                ]

            )
            ->add(
                'longueurChute',
                NumberType::class,
                [
                    'label' => 'Longueur de la chute:',
                    'attr' => [
                        'placeholder' => 'En mètres, centimètres',
                        'required' => false,
                    ],
                    'required' => false,
                ]

            )
            ->add(
                'longueurBordure',
                NumberType::class,
                [
                    'label' => 'Longueur de la bordure:',
                    'attr' => [
                        'placeholder' => 'En mètres, centimètres',
                    ],
                    'required' => false,
                ]

            )
            ->add(
                'matiere',
                TextType::class,
                [
                    'label' => 'Matière du tissu:',
                    'attr' => [
                        'placeholder' => 'Matière',

                    ],
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
                'data_class' => Voile::class,
            ]
        );
    }
}
