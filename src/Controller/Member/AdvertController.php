<?php


namespace App\Controller\Member;

use App\Security\Voters\AdvertVoter;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Advert;
use App\Service\Advert\FormBuilder;
use App\Service\Advert\FormHandler;
use App\Service\Advert\SearchProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/member/annonces", name="member_advert_")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route ("/liste", name="list")
     * @param SearchProvider $provider
     * @return Response
     */
    public function index(SearchProvider $provider):Response
    {
        return $this->render('member/advert/list.html.twig',
            [
                'adverts'=>$provider->getUserAdverts()
            ]);
    }

    /**
     * @Route ("/edition/{id}", name="edit")
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @param Request $request
     * @param Advert $advert
     * @return Response
     */
    public function edit(FormBuilder $formBuilder,FormHandler $formHandler,Request $request,Advert $advert):Response
    {
        $this->denyAccessUnlessGranted(AdvertVoter::EDIT,$advert);

        $form=$formBuilder->getEditForm($advert);
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'annonce a bien été modifiée !");
            return $this->redirectToRoute('member_advert_list');
        }

        return $this->render('member/advert/edit.html.twig',
            [
                'form'=>$form->createView()
            ]);
    }

    /**
     * @Route ("/suppression/{id}", name="delete")
     * @param FormHandler $formHandler
     * @param Request $request
     * @param Advert $advert
     * @return Response
     */
    public function delete(FormHandler $formHandler,Request $request,Advert $advert):Response
    {
        $this->denyAccessUnlessGranted(AdvertVoter::DELETE,$advert);

        $form = $this->createFormBuilder()->getForm();
        $formHandler->handleDeleteForm($request,$form,$advert);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'annonce a bien été suprimée !");
            return $this->redirectToRoute('member_advert_list');
        }

        return $this->render('member/advert/delete.html.twig',
            [
                'advert'=>$advert,
                'form'=>$form->createView()
            ]);
    }

    /**
     * @Route ("/ajout", name="new")
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @param Request $request
     * @return Response
     */
    public function new(FormBuilder $formBuilder,FormHandler $formHandler,Request $request):Response
    {
        $form = $formBuilder->getForm();
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'annonce a bien été ajoutée !");
            return $this->redirectToRoute('member_advert_list');
        }

        return $this->render('member/advert/new.html.twig',
            [
                'form'=>$form->createView()
            ]);
    }
}