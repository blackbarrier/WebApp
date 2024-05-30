<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
   #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        $rol = $this->getUser()->getRoles();
        // dd($rol);
 
        return $this->render('index/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
