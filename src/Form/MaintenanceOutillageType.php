<?php

namespace App\Form;

use App\Entity\MaintenanceOutillage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaintenanceOutillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation',TextType::class,
                ['label' => 'Désignation:',
                    'required' => true,
                ]
            )

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
                    'required' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label' => 'Date d\'execution:',
                ]
            )

            ->add('echeance',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'label' => 'Date d\'échéance:',
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaintenanceOutillage::class,
        ]);
    }
}
