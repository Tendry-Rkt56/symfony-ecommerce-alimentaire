<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UsersType;
use App\Trait\UploadedImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/users', name: 'admin.users.')]
#[IsGranted('ROLE_ADMIN')]
class UsersController extends AbstractController
{

    use UploadedImage;

    public function __construct (private EntityManagerInterface $entity)
    {
        
    }

    /**
     * Chargement de tous les utilisateurs dans la base de donnée
     * @param Request $request
     * @return Response
     */
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $page = $request->query->getInt('page', 1);
        $limit = 8;
        $users = $this->entity->getRepository(User::class)->paginateUser($page, $limit);
        $maxPages = ceil($users->count() / $limit);
        return $this->render('admin/users/index.html.twig', [
            'users' => $users,
            'page' => $page,
            'maxPages' => $maxPages,
        ]);
    }

    /**
     * Création d'un nouvel administrateur dans le site
     * @param Request $request 
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */
    #[Route('/create', name: 'create', methods: ['GET', 'POST'])]
    public function create (Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(UsersType::class, $user, [
            'attr' => [
                'class' => 'container forme d-flex align-items-center justify-content-center flex-column gap-2'
            ]
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('passwords')->getData(); // Mot de passe de l'utilisateur(Admin) connecté
            /** @var User $admin */
            $admin = $this->getUser();
            if ($hasher->isPasswordValid($admin, $password)) {
                $user->setRoles(['ROLE_ADMIN'])
                    ->setImage($this->checkImage($form->get('imageFile')->getData(), $user))
                    ->setPassword($hasher->hashPassword($user, $form->get('newPassword')->getData()));
                $this->entity->persist($user);
                $this->entity->flush();
                $this->addFlash('success', 'Nouvel utilisateur crée avec succès');
                return $this->redirectToRoute('admin.users.index');
            }
            else {
                $form->addError(new FormError('Votre mot de passe ne correspond pas'));
            }
        }
        return $this->render('admin/users/create.html.twig', [
            'form' => $form,
        ]);
    }


    /**
     * Pour la suppression d'un utilisateur dans la base de données
     * @param User $user
     * @return Response
     */
    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete (User $user): Response
    {
        $this->entity->remove($user);
        $this->entity->flush();
        $this->deleteImage($user);
        $this->addFlash('danger', 'L\'utilisateur a été supprimée');
        return $this->redirectToRoute('admin.users.index');
    }
}
