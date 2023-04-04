<?php

namespace App\Form;

use App\Entity\DocElectronique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocElectroniqueType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('docFilename',FileType::class,[
                    'label' => 'Choisir le fichier PDF à télécharger:',
                    'attr' => ['placeholder' => 'trouvez le  fichier PDF à téléchargeren cliquant sur Browse'],
                ]
            )
            ->add('description',TextType::class,array(
                'required' => true,
                'attr' => [
                    'placeholder' => '"Mode d\'emploi", "Facture", "Certificat", ..."'
                ],
            ));
    }
    /**
     * @param OptionsResolver $resolver
     * @noinspection ReturnTypeCanBeDeclaredInspection
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DocElectronique::class,
        ]);
    }
}
