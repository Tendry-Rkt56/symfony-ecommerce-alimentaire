<?php

namespace App\Controller\User;

use App\Entity\Articles;
use App\Entity\Commandes;
use App\Entity\Notification;
use App\Entity\Notifications;
use App\Entity\User;
use App\Event\DetailsEvent;
use App\Event\NotificationsEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/articles', name: 'articles.')]
class ArticleController extends AbstractController
{

    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 6;
        $articles = $this->entity->getRepository(Articles::class)->getPaginator($page, $limit);
        $maxPages = ceil($articles->count() / $limit);
        return $this->render('user/article/index.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'maxPages' => $maxPages,
        ]);
    }

    private function informations (array $data = [])
    {
        $ids = array_keys($data);
        $articles = $this->entity->getRepository(Articles::class)->getArticlesInPanier($ids);
        $total = 0;
        foreach($articles as $article) {
            $total += $data[$article->getId()] * $article->getPrice();
        }
        return [
            'total' => $total,
            'articles' => $articles,
        ];
    }

    #[Route('/panier', name: 'paniers')]
    public function paniers (SessionInterface $session)
    {
        extract($this->informations($session->get('articles', [])));
        return $this->render('user/article/panier.html.twig', [
            'articles' => $articles,
            'paniers' => $session->get('articles', []),
            'total' => $total
        ]);
    }

    #[Route('/panier/{id}', name: 'panier.add', methods: ['GET'])]
    public function addPanier (int $id, SessionInterface $session, Request $request)
    {
        $paniers = $session->get('articles', []);
        if (array_key_exists($id, $paniers)) {
            $paniers[$id]++;
        }
        else {
            $paniers[$id] = 1;
        }
        $session->set('articles', $paniers);
        $this->addFlash('success', 'Article ajouté à votre panier');
        return $this->redirectToRoute('articles.index');
    }

    #[Route('/panier/{id}', name: 'panier.delete', methods: ['DELETE'])]
    public function deleteInPanier (int $id, SessionInterface $session)
    {
        $paniers = $session->get('articles', []);
        if (array_key_exists($id, $paniers)) {
            if ($paniers[$id] <= 1) {
                unset($paniers[$id]);
            }
            elseif ($paniers[$id] > 0) {
                $paniers[$id]--;
            }
        }
        $session->set('articles', $paniers);
        return $this->redirectToRoute('articles.paniers');
    }

    #[Route('/panier/store', name: 'panier.store', methods: ['POST'])]
    public function storePanier (EventDispatcherInterface $dispatcher, SessionInterface $session)
    {
        extract($this->informations($session->get('articles', [])));
        $commande = new Commandes();
        $commande->setUser($this->getUser())
                 ->setCreatedAt(new \DateTimeImmutable())
                 ->setTotal($total);
        $this->entity->persist($commande);
        $this->entity->flush();
        $dispatcher->dispatch(new DetailsEvent($commande, $session->get('articles', [])));
        $dispatcher->dispatch(new NotificationsEvent(new Notifications(), Commandes::class, $commande));
        $session->set('articles', []);
        $this->addFlash('success', 'Votre commande a été passée avec succès');
        return $this->redirectToRoute('articles.index');
    }


}
