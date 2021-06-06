<?php


namespace App\Controller;


use App\Entity\Advert;
use App\Service\Advert\FormBuilder;
use App\Service\Advert\FormHandler;
use App\Service\Advert\SearchProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route ("/", name="index")
     * @param SearchProvider $provider
     * @param FormBuilder $formBuilder
     * @param Request $request
     * @param FormHandler $formHandler
     * @return Response
     */
    public function index(SearchProvider $provider,FormBuilder $formBuilder,Request $request,FormHandler $formHandler):Response
    {
        $form = $formBuilder->getSearchForm();
        $search=$formHandler->handleSearch($request,$form);
        return $this->render('index.html.twig',
        [
            'adverts'=>$provider->getLastAdvert($search),
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route ("/voir/{id}", name="show")
     * @param Advert $advert
     * @return Response
     */
    public function show(Advert $advert):Response
    {

        return $this->render('show.html.twig',
            [
                'advert'=>$advert
            ]);

    }
}