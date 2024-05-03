<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function profilAll(EntityManagerInterface $entityManager)
    {

        $UserRepository = $entityManager->getRepository(User::class);
        $users = $UserRepository->findAll();

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'users' => $users
        ]);
    }

    #[Route('/profil/modify', name: 'app_modify_profil')]
    public function profilModify(EntityManagerInterface $entityManager, Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(RegistrationFormType::class, $user);;
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/modify.html.twig', [
            'controller_name' => 'ProfilController',
            'form' => $form,
        ]);
    }
}
