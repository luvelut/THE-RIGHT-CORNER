<?php


namespace App\Service\Member;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;

class FormBuilder
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
    }

    public function getForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(UserType::class);
    }

    public function getEditForm(User $user) : FormInterface
    {
        return $this->container->get('form.factory')->create(UserType::class,$user);
    }
}