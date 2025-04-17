<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorie;
use App\Form\CategorieType;

final class CategorieController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) 
    {
    }

    #[Route('/categorie', name: 'app_categorie')]
    public function index(CategorieRepository $categorieRepository): Response
    {
        $categories = $categorieRepository->findAll();
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/categorie/add', name: 'app_categorie_add')]
    public function add(Request $request, CategorieRepository $categorieRepository ): Response
    {
        // Crée le formulaire pour ajouter une nouvelle catégorie
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($categorie);
            $this->entityManager->flush();
        }

        return $this->render('categorie/show.html.twig', [
            'categorie_form' => $form,
        ]);
    }
}
