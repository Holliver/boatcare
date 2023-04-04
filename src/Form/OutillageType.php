<?php

namespace App\Form;

use App\Entity\Outillage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OutillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options): void
    {
        $builder
            ->add('categorie',
                ChoiceType::class,
                options: [
                    'choices' => [
                        'Mécanique' => 'Mécanique',
                        'Electricité' => 'Electricité',
                        'Matelotage' => 'Matelotage',
                        'Divers' => 'Divers'
                    ],
                ]
            )
            ->add('designation',
                TextType::class,
                ['label' => 'Désignation :']
            )
            ->add('marque',
                TextType::class,
                [
                    'label' => 'Marque :',
                    'required' => false,
                ]
            )
            ->add('modele',
                TextType::class,
                [
                    'label' => 'Modèle :',
                    'required' => false,
                ]
            )
            ->add('anneeAchat',
                IntegerType::class,
                [
                    'label' => 'Année d\'achat :',
                    'required' => false,
                ]
            )
            ->add('quantite',
                IntegerType::class,
                ['label' => 'Quantité']
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Outillage::class,
        ]);
    }
}
