<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/category', name: 'admin.category.')]
#[IsGranted('ROLE_ADMIN')]
class CategoryController extends AbstractController
{

    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $categories = $this->entity->getRepository(Category::class)->findAll();
        return $this->render('admin/category/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * Pour la création d'une nouvelle catégorie
     * @param Request $request
     * 
     * @return Response
     */
    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create (Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category, [
            'attr' => [
                'class' => 'd-flex align-items-center justify-content-center flex-column gap-2'
            ],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $category->setCreatedAt(new \DateTimeImmutable())->setUpdatedAt(new \DateTimeImmutable());
            $this->entity->persist($category);
            $this->entity->flush();
            $this->addFlash('success', 'Catégorie ajoutée');
            return $this->redirectToRoute('admin.category.index');
        }
        return $this->render('admin/category/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'edit', methods: ['GET', 'POST'])]
    public function edit (Category $category, Request $request)
    {
        $form = $this->createForm(CategoryType::class, $category, [
            'attr' => [
                'class' => 'd-flex align-items-center justify-content-center flex-column gap-2',
            ],
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->isSubmitted() && $form->isValid()) {
                $category->setUpdatedAt(new \DateTimeImmutable());
                $this->entity->flush();
                $this->addFlash("success", 'catégorie édité avec succès');
                return $this->redirectToRoute('admin.category.index');
            }
        }
        return $this->render('admin/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete (Category $category)
    {
        $this->entity->remove($category);
        $this->entity->flush();
        $this->addFlash('danger', 'Catégorie supprimée');
        return $this->redirectToRoute('admin.category.index');
    }


}
