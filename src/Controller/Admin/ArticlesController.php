<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Form\ArticlesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/articles', name: 'admin.articles.')]
#[IsGranted('ROLE_ADMIN')]
class ArticlesController extends AbstractController
{

    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    /**
     * Affiche la liste des articles
     * @return Response La réponse HTTP avec le chargement de la vue
     */
    #[Route('/', name: 'index')]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 8;
        $articles = $this->entity->getRepository(Articles::class)->getPaginator($page, $limit);
        $maxPages = ceil($articles->count() / $limit);
        return $this->render('admin/articles/index.html.twig', [
            'articles' => $articles,
            'page' => $page,
            'maxPages' => $maxPages,
            'count' => $articles->count(),
        ]);
    }

    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create (Request $request): Response
    {
        $article = new Articles();
        $form = $this->createForm(ArticlesType::class, $article, [
            'attr' => [
                'class' => 'd-flex align-items-center justify-content-center flex-column gap-2',
            ],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article->setImage($this->checkImage($form->get('imageFile')->getData(), $article))
                    ->setCreatedAt(new \DateTimeImmutable());
            $this->entity->persist($article);
            $this->entity->flush();
            $this->addFlash('success', 'Nouvel article crée');
            return $this->redirectToRoute('admin.articles.index');
        }
        return $this->render('admin/articles/create.html.twig', [
            'form' => $form,
        ]);
    }
    

    /**
     * Pour la gestion du téléchargemen de l'image
     * @return string|null
     */
    private function checkImage (?UploadedFile $image = null, Articles $article): ?string
    {
        if ($article->getImage() == null && $image == null && !$image instanceof UploadedFile) return null;
        if ($article->getImage() !== null && $image == null && !$image instanceof  UploadedFile) return $article->getImage();
        else {
            $this->deleteImage($article);
            $image->move($this->getParameter('kernel.project_dir').'/public/image/articles/', $image->getClientOriginalName());
            return $image->getClientOriginalName();
        }
    }

    private function deleteImage (Articles $article): void
    {
        if ($article->getImage() !== null) {
            $path = $this->getParameter('kernel.project_dir').'/public/image/articles/'.$article->getImage();
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit (Request $request, Articles $article): Response
    {
        $form = $this->createForm(ArticlesType::class, $article, [
            'attr' => [
                'class' => 'd-flex align-items-center justify-content-center flex-column gap-2',
            ],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $article->setImage($this->checkImage($form->get('imageFile')->getData(), $article))
                        ->setUpdatedAt(new \DateTimeImmutable());
                $this->entity->flush();
                $this->addFlash("success", 'Article édité avec succès');
                return $this->redirectToRoute('admin.articles.index');
            }
        }
        return $this->render('admin/articles/edit.html.twig', [
            'article' => $article,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete (Articles $article): Response
    {
        $this->deleteImage($article);
        $this->entity->remove($article);
        $this->entity->flush();
        $this->addFlash('danger', 'Article supprimée');
        return $this->redirectToRoute('admin.articles.index');
    }
}
