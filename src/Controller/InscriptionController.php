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


    /*#[Route('/home/{id}', name: 'app_create_inscription')]

    public function createInscrip(Request $request, EntityManagerInterface $entityManager)
    {

        $createInscrip = new Inscription();
        $form = $this->createForm(InscriptionFormType::class, $createInscrip);
        $form->handleRequest($request);

        $entityManager->persist($createInscrip);
        $entityManager->flush();

        return $this->render('event/details.html.twig', [
            'controller_name' => 'EventController',
            'createInscrip' => $form
        ]);
    }



   /* #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }*/
}
