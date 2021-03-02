<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{




    /**
     * @Route("/test", name="test")
     */
    public function test(): Response
    {
        return $this->render('test.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
