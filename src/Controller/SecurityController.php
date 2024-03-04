<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/se-connecter', name: 'security_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('@EasyAdmin/page/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/se-deconnecter', name: 'security_logout')]
    public function logout(): void
    {
    }

    #[Route('politique-de-confidentialite', name: 'security_confidentiality')]
    public function confidentiality(): Response
    {
        return $this->render('security/confidentiality.html.twig');
    }
}
