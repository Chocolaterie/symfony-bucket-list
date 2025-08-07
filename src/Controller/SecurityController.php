<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Si déjà connecté(e) revenir à l'accueil
        if ($this->getUser()) {
            $this->addFlash("warning", "Vous êtes déjà connecté(e)");

            return $this->redirectToRoute('main_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        // Ajouter un flash message
        //$this->addFlash("success", "Vous êtes déconnecté(e) avec succès");

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
