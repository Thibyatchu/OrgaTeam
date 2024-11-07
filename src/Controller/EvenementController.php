<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EvenementController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) 
    {
    }

    #[Route('/evenement', name: 'app_evenement')]
    public function index(EvenementRepository $evenementRepository): Response
    {
        $evenements = $evenementRepository->findAll();
        return $this->render('evenement/index.html.twig', [
            'evenements' => $evenements,
        ]);
    }    

    #[Route('/evenement/add', name: 'app_evenement_add')]
    public function add(Request $request, EvenementRepository $evenementRepository): Response
    {
        $evenement = new Evenement();
        $form = $this->createForm(EvenementType::class, $evenement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            $this->entityManager->persist($evenement);
            $this->entityManager->flush();
        }

        $evenement = $evenementRepository->findAll();
        return $this->render('evenement/show.html.twig', [
            'evenements_form' => $form,
        ]);
    }

}
