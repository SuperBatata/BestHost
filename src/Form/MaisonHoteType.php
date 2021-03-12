<?php

namespace App\Form;

use App\Entity\MaisonHote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaisonHoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, [
                'attr' => array('class' => 'form-control')
            ])
            ->add('Prix', NumberType::class, [
                'attr' => array('class' => 'form-control')
            ])
            ->add('Adresse', TextType::class, [
                'attr' => array('class' => 'form-control')
            ])
            ->add('description', TextareaType::class, [
                'attr' => array('class' => 'form-control')
            ])
            ->add('type', ChoiceType::class, [
                'attr' => array('class' => 'form-control'),
                'choices' => [
                    'Villa' => 'villa',
                    'Apartement' => 'appartement',
                    'Autre' => 'autre',
                ]

            ])
            ->add('nombre_chambres', NumberType::class, [
                'attr' => array('class' => 'form-control')
            ])

            ->add('images', FileType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'ajouter images',
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaisonHote::class,
        ]);
    }
}
