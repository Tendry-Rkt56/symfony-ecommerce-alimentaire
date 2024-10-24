<?php

namespace App\Services;

use App\Repository\NotificationsRepository;

class NotificationsServices 
{

     public int $nombre;

     public function __construct (private NotificationsRepository $repository)
     {
          $this->nombre = $this->getNotifications();
     }

     public function getNotifications ()
     {
          return count($this->repository->getNotifications());
     }

}

?>