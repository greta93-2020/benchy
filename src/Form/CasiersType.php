<?php

namespace App\Form;

use App\Entity\Casiers;
use App\Entity\TypeCasier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Repository\TypeCasierRepository;

class CasiersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                                    'attr' => ['class' => 'form-group'],
                                    'label' => 'Nom'
                                ])
            ->add('type', EntityType::class, [
                                    'class' => TypeCasier::class,
                                    'query_builder' => function (TypeCasierRepository $er) {
                                        return $er
                                        ->findTypeCasiers();
                                    },
                                    'choice_value' => function (TypeCasier $entity = null) {
                                                        return $entity ? $entity->getId() : '';
                                                     },
                                    'choice_label' => 'nom',
                                    'attr' => ['class' => 'form-group'],
                                    'invalid_message' => 'casier.typeCasier.not_blank',
                                    'label' => 'Type'
                                ])
            ->add('ordre', IntegerType::class, [
                                    'attr' => ['class' => 'form-group'],
                                    'label' => 'Ordre',
                                    'required' => false
                                ])
            ->add('remarque', TextType::class, [
                                    'attr' => ['class' => 'form-group'],
                                    'label' => 'Remarque',
                                    'required' => false
                                ])
            ->add('tag', CheckboxType::class, [
                                    'label'    => 'Actif',
                                    // 'data' => true,
                                    'required' => false
                                ])
                // ->add('enregistrer', SubmitType::class, [
                //                         'attr' => [],
                //                         'label' => 'Enregistrer'
                //                     ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Casiers::class,
        ]);
    }
}
