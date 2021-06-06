<?php


namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminController extends AbstractController
{
    /**
     * @Route ("/admin/accueil", name="admin_index")
     * @return Response
     */
    public function index():Response
    {
        return $this->render('admin/index.html.twig');
    }
}