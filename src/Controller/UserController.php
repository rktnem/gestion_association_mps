<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): Response
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: '/user', name: "user.index")]
    public function index(UserRepository $repository): Response {
        $users = $repository->findAllUser();

        return $this->render('user/index.html.twig', [
            "users" => $users
        ]);
    }

    #[Route(path: '/user/{id}', name: "user.edit")]
    public function edit(User $user, Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute("user.index");
        }

        return $this->render("user/edit.html.twig", [
            "form" => $form
        ]);
    }

    #[Route(path: '/user/delete/{id}', name: "user.destroy")]
    public function destroy(User $user, EntityManagerInterface $em) {
        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("user.index");
    }
}