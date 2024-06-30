<?php

namespace App\Event;

use App\Entity\Commandes;

class DetailsEvent 
{

     public function __construct (public Commandes $commande, public array $paniers = [])
     {
          
     }

}

?>
