<?php


namespace App\Controller;


use App\Service\Member\FormBuilder;
use App\Service\Member\FormHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route ("/connexion", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils):Response
    {
        $lastLogin=$authenticationUtils->getLastUsername();
        $error=$authenticationUtils->getLastAuthenticationError();

        return $this->render('security/login.html.twig', [
            'last_login'=>$lastLogin,
            'error'=>$error
        ]);
    }

    /**
     * @Route ("/inscription", name="register")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function register(FormBuilder $formBuilder,FormHandler $formHandler,Request $request):Response
    {
        $form = $formBuilder->getForm();
        $formHandler->handleForm($request,$form);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', "Vous êtes maintenant membre de The Right Corner, vous pouvez vous identifier !");
            return $this->redirectToRoute('login');
        }

        return $this->render('security/register.html.twig',
        [
            'form'=>$form->createView()
        ]);
    }
}