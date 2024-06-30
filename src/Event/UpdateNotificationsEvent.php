<?php

namespace App\Event;

use App\Entity\Commandes;

class UpdateNotificationEvent
{

     public function __construct (public Commandes $commande, public string $newVal)
     {
          
     }

}