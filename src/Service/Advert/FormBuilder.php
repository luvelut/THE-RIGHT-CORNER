<?php


namespace App\Service\Advert;


use App\Entity\Advert;
use App\Form\AdvertType;
use App\Form\Search\AdvertSearchType;
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
        return $this->container->get('form.factory')->create(AdvertType::class);
    }

    public function getEditForm(Advert $advert) : FormInterface
    {
        return $this->container->get('form.factory')->create(AdvertType::class,$advert);
    }

    public function getSearchForm() : FormInterface
    {
        return $this->container->get('form.factory')->create(AdvertSearchType::class);
    }

}