<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PrestataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)
            ->add('first_name',TextType::class)
            ->add('last_name',TextType::class)
            ->add('password',PasswordType::class)
            ->add('confirm_password',PasswordType::class)
            ->add('roles',ChoiceType::class,
            [
                'choices'=> [
                    'Hote'=>'ROLE_GERANT_MAISON_HOTE',
                    'Gerant_Camping'=> 'ROLE_GERANT_CAMPING',
                    'Gerant_Secteur_d\'activité'=>'ROLE_GERANT_SECTEUR_ACTIVITE',
                ],
                'expanded'=>true,
                'multiple'=>false,
                'label'=>'Rôles',

            ])
            ->add('cin',NumberType::class)

        ;

        $builder->get('roles')
            ->addModelTransformer(new CallbackTransformer(
                function ($rolesArray)
                {
                    return count($rolesArray)?$rolesArray[0]:null;
                },
                function($rolesString)
                {
                    return [$rolesString];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
