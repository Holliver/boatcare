<?php

namespace App\Form;

use App\Entity\Administration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdministrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numFrancisation',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => 'N° de francisation'
                ],
            ))
            ->add('numImatriculation',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => "N° d'immatriculation"
                ],
            ))
            ->add('numLicenceStationNavire',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => "N° de licence station navire"
                ],
            ))
            ->add('MMSI',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => "N° MMSI AIS"
                ],
            ))
            ->add('indicatifAppel',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => "Indicatif d'appel radio du navire"
                ],
            ))
            ->add('cieAssurance',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => "Nom de la Cie d'assurance"
                ],
            ))
            ->add('emailCourtierAss',TextType::class,array(
                'required' => false,
                'attr' => [
                    'placeholder' => "Email du courtier d'assurance"
                ],
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Administration::class,
        ]);
    }
}
