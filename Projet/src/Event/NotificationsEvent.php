<?php

namespace App\Event;

use App\Entity\Commandes;
use App\Entity\Notifications;

class NotificationsEvent 
{
     public function __construct (public Notifications $notification, public string $class, public Commandes $commande)
     {
          
     }
}