<?php


namespace App\Controller\Admin;

use App\Entity\User;
use App\Security\Voters\UserVoter;
use App\Service\Member\FormBuilder;
use App\Service\Member\FormHandler;
use App\Service\Member\SearchProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/membres", name="admin_member_")
 */
class MemberController extends AbstractController
{
    /**
     * @Route ("/list", name="list")
     * @param SearchProvider $provider
     * @return Response
     */
    public function index(SearchProvider $provider):Response
    {
        return $this->render('admin/member/list.html.twig',
        [
            'members'=>$provider->getMembers()
        ]);
    }

    /**
     * @Route ("/ajout", name="new")
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @return Response
     */
    public function new(Request $request,FormBuilder $formBuilder,FormHandler $formHandler):Response
    {
        $form=$formBuilder->getForm();
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'utilisateur a bien été ajouté !");
            return $this->redirectToRoute('admin_member_list');
        }

        return $this->render('admin/member/new.html.twig',
            [
                'form'=>$form->createView()
            ]);
    }

    /**
     * @Route ("/edition/{id}", name="edit")
     * @param User $user
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @return Response
     */
    public function edit(User $user,Request $request,FormBuilder $formBuilder,FormHandler $formHandler):Response
    {
        $this->denyAccessUnlessGranted(UserVoter::EDIT_ADMIN,$user);

        $form=$formBuilder->getEditForm($user);
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'utilisateur a bien été modifié !");
            return $this->redirectToRoute('admin_member_list');
        }

        return $this->render('admin/member/edit.html.twig',
            [
                'form'=>$form->createView()
            ]);
    }

    /**
     * @Route ("/suppression/{id}", name="delete")
     * @param User $user
     * @param Request $request
     * @param FormHandler $formHandler
     * @return Response
     */
    public function delete(User $user,Request $request,FormHandler $formHandler):Response
    {
        $this->denyAccessUnlessGranted(UserVoter::DELETE_ADMIN,$user);

        $form = $this->createFormBuilder()->getForm();
        $formHandler->handleDeleteForm($request,$form,$user);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "L'utilisateur a bien été supprimé !");
            return $this->redirectToRoute('admin_member_list');
        }

        return $this->render('admin/member/delete.html.twig',
            [
                'member'=>$user,
                'form'=>$form->createView()
            ]);
    }
}