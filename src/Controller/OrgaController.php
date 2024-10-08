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
    #[Route('/', name: 'homepage')]
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('orga/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

    #[Route('/equipe/{id}', name: 'equipe')]
    public function show(Request $request, Equipe $equipe, CategorieRepository $categorieRepository): Response
    {
        $categorie = new Comment();
        $form = $this->createForm(CommentType::class, $categorie);

        return $this->render('orga/show.html.twig', [
            'equipe' => $equipe,
            'categorie' => $categorieRepository->findBy(['equipe' => $equipe]),
            'categorie_form' => $form->createView(),
        ]);
    }

}
