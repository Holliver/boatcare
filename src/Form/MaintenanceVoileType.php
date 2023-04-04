<?php

namespace App\Form;

use App\Entity\MaintenanceVoile;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceVoileType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add('designation',TextType::class,
                ['label' => 'Désignation:',
                    'required' => true,
                ]
            )
            ->add(
                'fourniture',
                TextareaType::class,
                ['required' => false,
                    'label' => 'Fournitures et commentaires:',]
            )
            ->add(
                'rythme',
                ChoiceType::class,
                [
                    'choices' =>
                        [
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
                    'label' => 'Date dernière execution:',
                    'required' => false,
                ]
            )
            ->add(
                'echeance',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label' => 'Date d\'échéance:',
                    'required' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaintenanceVoile::class,
        ]);
    }
}
