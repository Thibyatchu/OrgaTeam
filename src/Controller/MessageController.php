<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MessageController extends AbstractController
{
    #[Route('/message', name: 'app_message')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $nom = $request->request->get('nom');
            $prenom = $request->request->get('prenom');
            $email = $request->request->get('email');
            $libelle = $request->request->get('libelle');

            $message = new Message();
            $message->setNom($nom);
            $message->setPrenom($prenom);
            $message->setEmail($email);
            $message->setLibelle($libelle);
            $message->setTraiter(false); // Ajouté pour éviter la valeur NULL

            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a bien été envoyé !');
            return $this->redirectToRoute('app_message');
        }

        return $this->render('message/index.html.twig');
    }

    #[Route('/message/add', name: 'app_message_add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();

            $this->addFlash('success', 'Message envoyé avec succès !');
            return $this->redirectToRoute('app_message_add');
        }

        return $this->render('message/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
