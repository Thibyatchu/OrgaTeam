<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Admin;
use App\Form\AdminUserType;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    
    #[Route('/', name: 'app_user_login')]
    public function userLogin(AuthenticationUtils $authenticationUtils): Response
    {
        // Récupère l'erreur de connexion s'il y en a une
        $error = $authenticationUtils->getLastAuthenticationError();

        // Dernier nom d'utilisateur saisi
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/user_login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_user_logout')]
    public function userLogout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/register', name: 'app_user_register')]
    public function userRegister(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        // Crée une nouvelle instance de l'entité Admin
        $admin = new Admin();

        // Crée le formulaire pour l'utilisateur
        $form = $this->createForm(AdminUserType::class, $admin);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Hache le mot de passe de l'utilisateur
            $hashedPassword = $passwordHasher->hashPassword($admin, $admin->getPassword());
            $admin->setPassword($hashedPassword);

            // Définit le rôle par défaut pour l'utilisateur
            $admin->setRoles(['ROLE_USER']);

            // Sauvegarde l'utilisateur dans la base de données
            $entityManager->persist($admin);
            $entityManager->flush();

            // Redirige vers la page de login après l'enregistrement
            return $this->redirectToRoute('app_user_login');
        }

        // Affiche le formulaire d'enregistrement
        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
