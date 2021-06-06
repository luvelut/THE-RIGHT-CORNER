<?php


namespace App\Form;

use App\Entity\Advert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdvertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',
            TextType::class,
                [
                    'label' => "Titre : ",
                    'attr'=> ['class'=> 'form-control']
                ]
            )
            ->add('content',
                TextType::class,
                [
                    'label' => "Description : ",
                    'attr'=> ['class'=> 'form-control']
                ]
            )
            ->add('price',
                NumberType::class,
                [
                    'label' => "Prix de vente : ",
                    'attr'=> ['class'=> 'form-control']
                ]
            )
            ->add('imageFile',
                FileType::class,
                [
                    'label' => "Photo : ",
                    'attr'=> ['class'=> 'form-control']
                ]
            )
        ;
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Advert::class,
            ]
        );
    }
}