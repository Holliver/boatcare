<?php

namespace App\Form;

use App\Entity\MaintenanceAdministration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceAdministrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        /**
         * @param FormBuilderInterface $builder
         * @param array $options
         */
        $builder
            ->add('designation',TextType::class,
                [
                    'label' => 'Désignation:',
                ])
            ->add(
                'rythmeadministration',
                ChoiceType::class,
                [
                    'choices' =>
                        [
                            'Annuelle' => 'Annuelle',
                            'Echéance' => 'Échéance',
                        ],
                    'label' => 'Périodicité:',
                    'required' => false,
                ]
            )
            ->add(
                'faitle',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'label' => 'Date de la dernière exécution:',
                    'required' => false,
                ]
            )
            ->add(
                'echeance',
                DateType::class,
                [
                    'label' => 'Date limite légale ou souhaitable:',
                    'widget' => 'single_text',
                    'required' => false,
                ]
            );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaintenanceAdministration::class,
        ]);
    }
}
