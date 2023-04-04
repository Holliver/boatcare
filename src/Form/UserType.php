<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            /*->add('firstName',TextareaType::class,
                ['label' => 'Prénom',
                    'attr' => [
                        'placeholder' => 'Votre prénom'
                    ]
                ])
            ->add('lastName',TextareaType::class,
                ['label' => 'Nom',
                    'attr' => [
                        'placeholder' => 'Votre nom'
                    ]
                ])
            ->add('username')*/
            ->add('email',EmailType::class,
                ['label' => 'Email',
                    'attr' => [
                        'placeholder' => 'Votre adresse email'
                    ]
                ])
            ->add('password',PasswordType::class,
                ['label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Choisissez un bon mot de passe'
                    ]
                ])
            ->add('confirm_password',PasswordType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }
}
