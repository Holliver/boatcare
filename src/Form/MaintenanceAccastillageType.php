<?php

namespace App\Form;

use App\Entity\MaintenanceAccastillage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceAccastillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation',TextType::class,
                ['label' => 'Désignation:',
                    'required' => true,
                ]
            )
            ->add('categorieMaintenance')
            ->add('fourniture',
                TextareaType::class,
                [
                    'required' => false,
                    'label' => 'Fournitures:',
                ]
            )
            ->add('faitle',
                DateType::class,
                [
                    'label' => 'Date d\'éxécution de la maintenance:',
                    'widget' => 'single_text',
                    'required' => false,
                ]
            )
            ->add('rythme',
                ChoiceType::class,
                [
                    'choices' =>
                        [
                            'Annuelle' => 'Annuelle',
                            'Echéance' => 'A l\'échéance',
                        ],
                    'label' => 'Périodicité:',
                    'required' => false,
                ]
            )
            ->add('echeance',
                DateType::class,
                [
                    'label' => 'Date limite légale ou souhaitable:',
                    'widget' => 'single_text',
                    'required' => false,
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaintenanceAccastillage::class,
        ]);
    }
}
