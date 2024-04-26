<?php

namespace App\Controller;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event')]
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/home', name: 'app_home_event')]

    public function EventAll(EntityManagerInterface $entityManager)
    {

        $eventRepository = $entityManager->getRepository(Event::class);
        $events = $eventRepository->findAll();


        return $this->render('home/index.html.twig', [
            'controller_name' => 'EventController',
            'events' => $events
        ]);
    }
}
