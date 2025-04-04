<?php

namespace App\Controller;

use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AdminController extends AbstractController
{
    private $jwtManager;
    private $passwordHasher;

    public function __construct(JWTTokenManagerInterface $jwtManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->jwtManager = $jwtManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function token(Request $request): Response
    {
        $username = $request->get('username');
        $password = $request->get('password');

        // Vous pouvez ajouter ici un appel à votre service de gestion des utilisateurs pour vérifier le mot de passe
        $user = $this->getDoctrine()->getRepository(Admin::class)->findOneBy(['username' => $username]);

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            return new Response('Invalid credentials', Response::HTTP_UNAUTHORIZED);
        }

        // Si les identifiants sont valides, générer un JWT
        $token = $this->jwtManager->create($user);

        return $this->json(['token' => $token]);
    }
}
