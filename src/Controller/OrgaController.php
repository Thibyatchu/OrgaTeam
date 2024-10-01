<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrgaController extends AbstractController
{
    #[Route('/', name: 'app_orga')]
    public function index(): Response
    {
        return $this->render('orga/index.html.twig', [
            'controller_name' => 'OrgaController',
        ]);
    }
}
