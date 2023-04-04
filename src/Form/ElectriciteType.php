<?php

namespace App\Form;

use App\Entity\Electricite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ElectriciteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add('designation',
                TextType::class,
                ['label' => 'Désignation :']
            )
            ->add('marque',
                TextType::class,
                ['label' => 'Marque :',
                    'required' => false,
                ]
            )
            ->add('modele',
                TextType::class,
                ['label' => 'Modèle :']
            )
            ->add('anneeAchat',
                IntegerType::class,
                ['label' => 'Année d\'achat :']
            )
            ->add('quantite',
                IntegerType::class,
                ['label' => 'Quantité']
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Electricite::class,
        ]);
    }
}
