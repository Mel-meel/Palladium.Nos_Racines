<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    #[Route('/debug/roles', name: 'debug_roles')]
    public function debugRoles(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return new Response('No user is logged in.');
        }

        return new Response('Roles: ' . implode(', ', $user->getRoles()));
    }
}