<?php

namespace App\Form;

use App\Entity\MaintenanceBateau;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceBateauType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add('designation', TextType::class,
                [
                    'required' => true,
                    'label' => 'Désignation:',
                ])
            ->add(
                'fourniture',
                TextareaType::class,
                [
                    'required' => false,
                    'label' => 'Fournitures:',
                    ]
            )
            ->add(
                'rythmebateau',
                ChoiceType::class,
                [
                    'choices' => [
                        'Annuel' => 'Annuel',
                        'Souvent' => 'Souvent',
                        'Echéance' => 'Echéance',
                    ],
                    'label' => 'Périodicité:',
                ]
            )
            ->add(
                'faitle',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'label' => 'Date de la dernière execution:',
                    'required' => false,
                ]
            )
            ->add(
                'echeance',
                DateType::class,
                [
                    'label' => 'Date limite:',
                    'widget' => 'single_text',
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => MaintenanceBateau::class,
            ]
        );
    }
}
