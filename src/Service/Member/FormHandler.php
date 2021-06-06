<?php


namespace App\Service\Member;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class FormHandler
{
    private UserPasswordEncoderInterface $passwordEncoder;
    private CrudManager $crudManager;
    private ContainerInterface $container;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, CrudManager $crudManager, ContainerInterface $container)
    {
        $this->passwordEncoder=$passwordEncoder;
        $this->crudManager=$crudManager;
        $this->container=$container;
        $this->entityManager=$this->container->get('doctrine')->getManager();
    }


    public function handleForm(Request $request, FormInterface $form)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setIsAdmin(false);
            if(!($user->getCreatedAt())){
                $user->setCreatedAt(new \DateTime('now'));
            }
            $this->entityManager->persist($user);
        }

        $this->crudManager->save();
    }

    public function handleDeleteForm(Request $request, FormInterface $form,User $user)
    {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userAdverts=$user->getAdverts();
            foreach ($userAdverts as $advert){
                $this->entityManager->remove($advert);
            }

            $this->entityManager->remove($user);
        }

        $this->crudManager->save();
    }

}