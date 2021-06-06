<?php


namespace App\Service\Advert;


use Symfony\Component\DependencyInjection\ContainerInterface;

class CrudManager
{
    private ContainerInterface $container;
    private $entityManager;

    /**
     * CrudManager constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container=$container;
        $this->entityManager=$this->container->get('doctrine')->getManager();
    }


    public function save()
    {
        $this->entityManager->flush();
    }

}