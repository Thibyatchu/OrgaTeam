<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EquipeController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) 
    {
    }
    #[Route('/equipe', name: 'app_equipe')]
    public function index(EquipeRepository $equipeRepository): Response
    {
        $equipes = $equipeRepository->findAll();
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    #[Route('/equipe/add', name: 'app_equipe_add')]
    public function add(Request $request, EquipeRepository $equipeRepository): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            $this->entityManager->persist($equipe);
            $this->entityManager->flush();
        }

        $equipe = $equipeRepository->findAll();
        return $this->render('equipe/show.html.twig', [
            'equipes_form' => $form,
        ]);
    }
}
