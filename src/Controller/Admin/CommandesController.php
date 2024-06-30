<?php

namespace App\Controller\Admin;

use App\Entity\Commandes;
use App\Entity\Details;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/commandes', name: 'admin.commandes.')]
#[IsGranted('ROLE_ADMIN')]
class CommandesController extends AbstractController
{

    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    #[Route('/{id}', name: 'commande')]
    public function commande (Commandes $commande): Response
    {
        /** @var Details $details */
        $details = $this->entity->getRepository(Details::class)->findBy(['commande' => $commande->getId()]);
        $id = $commande->getId();
        // $details = $this->entity->getRepository(Details::class)->getDetails($id);
        return $this->render('admin/commandes/index.html.twig', [
            'commande' => $commande,
            'details' => $details,
            'total' => $commande->getTotal(),
        ]);
    }

    
}
