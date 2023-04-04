<?php

namespace App\Form;

use App\Entity\DocOutillage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocOutillageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docFilename',FileType::class,array(
                    'label' => 'Choisir le fichier PDF à télécharger:',
                    'attr' => ['placeholder' => 'trouvez le  fichier PDF à télécharger en cliquant sur Browse'],
                )
            )
            ->add('description',TextType::class,array(
                'required' => true,
                'attr' => [
                    'placeholder' => 'nom du lien: "Mode d\'emploi", "Facture", "Certificat", ..."'
                ],
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DocOutillage::class,
        ]);
    }
}
