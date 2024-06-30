<?php

namespace App\Controller\Admin;

use App\Entity\Notifications;
use App\Entity\User;
use App\Event\NotificationsReadEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/notifications', name: 'admin.notifications.')]
#[IsGranted('ROLE_ADMIN')]
class NotificationsController extends AbstractController
{

    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    #[Route('/', name: 'index')]
    public function index(EventDispatcherInterface $dispatcher): Response
    {
        $notRead = count($this->entity->getRepository(Notifications::class)->getNotifications());
        $notifications = $this->entity->getRepository(Notifications::class)->getAll();
        $dispatcher->dispatch(new NotificationsReadEvent());
        return $this->render('admin/notifications/index.html.twig', [
            'notRead' => $notRead,
            'notifications' => $notifications,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete (Notifications $notification)
    {
        $this->entity->remove($notification);
        $this->entity->flush();
        $this->addFlash('danger', 'Commande supprimée');
        return $this->redirectToRoute('admin.notifications.index');
    }
}
