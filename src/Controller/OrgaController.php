<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Equipe;
use App\Form\CommentType;
use App\Repository\CategorieRepository;
use App\Repository\EquipeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrgaController extends AbstractController
{
    #[Route('/admin', name: 'homepage')]
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('orga/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

}
