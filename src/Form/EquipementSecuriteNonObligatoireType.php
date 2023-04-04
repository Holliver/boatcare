<?php

namespace App\Form;

use App\Entity\EquipementSecurite;
use App\Entity\MaterielSecuriteLegal;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EquipementSecuriteNonObligatoireType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('materielSecuriteLegal',
                EntityType::class,
                array(
                    'class' => MaterielSecuriteLegal::class,
                    'query_builder' => function (EntityRepository $er) use ($options) {
                        return $er->createQueryBuilder('materielSecuriteLegal')
                            ->where('materielSecuriteLegal.bateau = :bat')
                            ->setParameter('bat',$options['bateau']);
                    },
                    'choice_label' => function ($allChoices) {
                        return $allChoices->getDesignation();
                    },
                    'label' => 'categorie mat se securité :',
                    'required' => true,
                ))
            ->add('designation',TextType::class)
            ->add('quantite',IntegerType::class)
            ->add('marque')
            ->add('datePeremption',
                DateType::class,
                [
                    'label' => 'Date de péremption: ',
                    'widget' => 'single_text',
                    'required' => false,
                ])
            ->add('dateProchaineRevision',
                DateType::class,
                [
                    'label' => 'Date prochaine révision:',
                    'widget' => 'single_text',
                    'required' => false,
                ])
            ->add('renouvellementAnnuel')
            ->add('anneeEnCours');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EquipementSecurite::class,
            'bateau' => null,
        ]);
    }
}
