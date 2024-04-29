<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\EventFormType;
use App\Form\InscriptionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{


  /*  #[Route('/profil', name: 'app_all_inscription')]
    public function threadAllByUser(EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $inscriptionRepository = $entityManager->getRepository(Inscription::class);
        $inscripUser = $inscriptionRepository->findBy(['user' => $user]);

        return $this->render('event/details.html.twig', [
            'inscripUser' => $inscripUser
        ]);
    }*/
}
