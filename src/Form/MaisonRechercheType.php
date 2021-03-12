<?php

namespace App\Form;

use App\Entity\MaisonRecherche;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MaisonRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', null, [
                'label' => 'Recherche par Nom ',
                'attr' => [
                    'requied' => false,
                    'placeholder' => 'Entrer le nom d\'une Maiosn d\'hote'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MaisonRecherche::class,

        ]);
    }
}
