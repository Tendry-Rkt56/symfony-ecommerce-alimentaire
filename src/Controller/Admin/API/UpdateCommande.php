<?php

namespace App\Controller\Admin\API;

use App\Entity\Articles;
use App\Entity\Commandes;
use App\Event\UpdateNotificationEvent;
use App\Repository\CommandesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\Exception\AccessException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UpdateCommande extends AbstractController
{


     public function __construct (private EntityManagerInterface $entity)
     {
          
     }

     #[Route('/api/commandes/update', name: 'api.commandes.update', methods: ['POST'])]
     public function update (Request $request, CommandesRepository $repository, EventDispatcherInterface $dispatcher)
     {
          if (!$request->headers->has('autorisation') && !$request->headers->get('autorisation') == 'message') {
               throw new AccessException('Votre donnée est invalide');
          }
          else {
               $data = json_decode($request->getContent());
               $valeur = filter_var($data->valeur, FILTER_VALIDATE_BOOL);
               /** @var Commandes $commande */
               $commande = $repository->find($data->id);
               $commande->setFinished($valeur);
               try {
                    if ($valeur) {
                         $dispatcher->dispatch(new UpdateNotificationEvent($commande, "Commande déjà effectuée"));
                    }
                    else {
                         $dispatcher->dispatch(new UpdateNotificationEvent($commande, "Nouvelle commande enregistrée"));
                    }
               }
               catch (Exception $e) {
                    echo $e->getMessage();
               }
               $this->entity->flush();
               return new JsonResponse([
                    'success' => true
               ]);
          }
     }

}