<?php

namespace App\Form;

use App\Entity\MaterielSecuriteLegal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaterielSecuriteLegalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('designation')
            ->add('navcotiere')
            ->add('semihauturiere')
            ->add('haututiere')
            ->add('commentaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaterielSecuriteLegal::class,
        ]);
    }
}
