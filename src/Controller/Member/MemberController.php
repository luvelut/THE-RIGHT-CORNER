<?php


namespace App\Controller\Member;

use App\Entity\User;
use App\Security\Voters\UserVoter;
use App\Service\Member\FormBuilder;
use App\Service\Member\FormHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MemberController extends AbstractController
{
    /**
     * @Route ("/membre/accueil", name="member_index")
     * @return Response
     */
    public function index():Response
    {
        return $this->render('member/index.html.twig');
    }

    /**
     * @Route ("mon-profil/edition", name="member_edit")
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param FormHandler $formHandler
     * @return Response
     */
    public function edit(Request $request,FormBuilder $formBuilder,FormHandler $formHandler):Response
    {
        $user=$this->getUser();
        $this->denyAccessUnlessGranted(UserVoter::EDIT,$user);
        $form=$formBuilder->getEditForm($user);
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "Votre profil a bien été modifié !");
            return $this->redirectToRoute('member_index');
        }

        return $this->render('member/account/edit.html.twig',
            [
                'form'=>$form->createView()
            ]);
    }
}