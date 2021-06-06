<?php


namespace App\Service\Advert;


use App\Entity\Advert;
use App\Entity\User;
use App\Model\Search\AdvertSearch;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

class FormHandler
{
    private CrudManager $crudManager;
    private ContainerInterface $container;
    private $entityManager;
    private Security $security;

    public function __construct(CrudManager $crudManager, ContainerInterface $container,Security $security)
    {
        $this->crudManager=$crudManager;
        $this->container=$container;
        $this->security=$security;
        $this->entityManager=$this->container->get('doctrine')->getManager();
    }

    public function handleForm(Request $request, FormInterface $form)
    {
        $user=$this->security->getUser();
        if (!($user instanceof User)) {
            return;
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $advert=$form->getData();
            $advert->setPublishedAt(new \DateTime('now'));
            $advert->setPublisher($user);
            $this->entityManager->persist($advert);
            $this->crudManager->save();
        }
    }

    public function handleDeleteForm(Request $request, FormInterface $form,Advert $advert)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->remove($advert);
        }

        $this->crudManager->save();
    }

    public function handleSearch(Request $request, FormInterface $form) : AdvertSearch
    {
        $search = new AdvertSearch();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $search=$form->getData();
        }
        return $search;
    }
}