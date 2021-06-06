<?php


namespace App\Controller\Admin;


use App\Entity\Advert;
use App\Security\Voters\AdvertVoter;
use App\Service\Advert\FormBuilder;
use App\Service\Advert\FormHandler;
use App\Service\Advert\SearchProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/annonces", name="admin_advert_")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route ("/list", name="list")
     * @param SearchProvider $provider
     * @return Response
     */
    public function index(SearchProvider $provider):Response
    {
        return $this->render('admin/advert/list.html.twig',
        [
            'adverts'=>$provider->getAdverts()
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
        $this->denyAccessUnlessGranted(AdvertVoter::EDIT_ADMIN,$advert);

        $form=$formBuilder->getEditForm($advert);
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'annonce a bien été modifiée !");
            return $this->redirectToRoute('admin_advert_list');
        }

        return $this->render('admin/advert/edit.html.twig',
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
        $this->denyAccessUnlessGranted(AdvertVoter::DELETE_ADMIN,$advert);

        $form = $this->createFormBuilder()->getForm();
        $formHandler->handleDeleteForm($request,$form,$advert);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'annonce a bien été suprimée !");
            return $this->redirectToRoute('admin_advert_list');
        }

        return $this->render('admin/advert/delete.html.twig',
            [
                'advert'=>$advert,
                'form'=>$form->createView()
            ]);
    }
}