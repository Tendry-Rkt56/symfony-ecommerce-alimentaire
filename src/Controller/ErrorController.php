<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/error', name: 'error.')]
class ErrorController extends AbstractController
{
    #[Route('/access', name: 'access', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('error/access.html.twig');
    }
}
