<?php


namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, [
                'label' => 'Login : ',
                'attr'=> ['class'=> 'form-control']
            ])
            ->add(
                'plainPassword',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'first_options'  => array(
                        'label' => 'Mot de passe : ',
                        'attr'=> ['class'=> 'form-control']
                    ),
                    'second_options' => array(
                        'label' => 'Répéter le mot de passe : ',
                        'attr'=> ['class'=> 'form-control']
                    )
                ]
            )
            ->add('name', TextType::class, [
                'label' => "Nom d'utilisateur : ",
                'attr'=> ['class'=> 'form-control']
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
            ]
        );
    }
}