<?php

namespace App\EventSubscriber;

use App\Entity\Articles;
use App\Entity\Details;
use App\Entity\Notifications;
use App\Event\DetailsEvent;
use App\Event\NotificationsEvent;
use App\Event\NotificationsReadEvent;
use App\Event\UpdateNotificationEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NotificationsSubscriber implements EventSubscriberInterface
{
    
    
    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    public function updateNotificationEvent (UpdateNotificationEvent $event)
    {   
        /** @var Notifications $notification */
        $notification = $this->entity->getRepository(Notifications::class)->findBy(['commande' => $event->commande->getId()]);
        $notification[0]->setValeur($event->newVal);
        $this->entity->flush();
    }
    
    public function onNotificationsEvent(NotificationsEvent $event): void
    {
        $notification = $event->notification->setValeur('Nouvelle commande enregistrée')
                            ->setCreatedAt(new \DateTimeImmutable())
                            ->setClass($event->class)
                            ->setCommande($event->commande);
        $this->entity->persist($notification);
        $this->entity->flush();
    }

    public function insertDetailsCommandes (DetailsEvent $event)
    {
        foreach($event->paniers as $id => $nombre) {
            $details = new Details();
            $article = $this->entity->getRepository(Articles::class)->find($id);
            $details->setArticles($article)
                    ->setCommande($event->commande)
                    ->setNombre($nombre);
            $this->entity->persist($details);
        }
        $this->entity->flush();
    }

    public function setReadNotif ()
    {
        $this->entity->getRepository(Notifications::class)->setRead();
    }

    public static function getSubscribedEvents(): array
    {
        return [
            NotificationsEvent::class => 'onNotificationsEvent',
            DetailsEvent::class => 'insertDetailsCommandes',
            NotificationsReadEvent::class => 'setReadNotif',
            UpdateNotificationEvent::class => 'updateNotificationEvent',
        ];
    }
}
