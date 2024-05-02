<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use App\Entity\Inscription;
use App\Entity\Rank;
use App\Entity\ResponseEntity;
use App\Entity\User;
use App\Form\EventFormType;
use App\Form\InscriptionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EventController extends AbstractController
{


    #[Route('/create', name: 'app_create_event')]

    public function creatEvent(Request $request, EntityManagerInterface $entityManager)
    {

        $createEvent = new Event();
        $form = $this->createForm(EventFormType::class, $createEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();
            if ($user) {
                $createEvent->setUser($user);
            }

            $entityManager->persist($createEvent);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('event/create.html.twig', [
            'controller_name' => 'EventController',
            'createEvent' => $form
        ]);
    }


    #[Route('/event', name: 'app_event')]
    public function index(): Response
    {
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }


    #[Route('/home/{id}', name: 'app_home_details')]

    public function eventDetails($id, EntityManagerInterface $entityManager, Request $request)
    {

        $user = $this->getUser();

        $eventRepository = $entityManager->getRepository(Event::class);
        $events = $eventRepository->find($id);

        $createInscrip = new Inscription();

        $form = $this->createForm(InscriptionFormType::class, $createInscrip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            if ($user) {
                $createInscrip->setUser($user);
                $createInscrip->setEvent($events);
            }

            $entityManager->persist($createInscrip);
            $entityManager->flush();

            return $this->redirectToRoute('app_profil');
        }

        $inscriptionRepository = $entityManager->getRepository(Inscription::class);
        $inscripUser = $inscriptionRepository->findBy(['user' => $user, 'event' => $events]);

        return $this->render('event/details.html.twig', [
            'controller_name' => 'EventController',
            'user' => $user,
            'events' => $events,
            'createInscrip' => $form,
            'inscripUser' => $inscripUser,
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

    #[Route('/filter', name: 'app_event_filter')]

    public function EventFilter(EntityManagerInterface $entityManager)
    {

        $eventRepository = $entityManager->getRepository(Event::class);
        $events = $eventRepository->findAll();

        $categoryRepository = $entityManager->getRepository(Category::class);
        $categories = $categoryRepository->findAll();

        return $this->render('event/filter.html.twig', [
            'controller_name' => 'EventController',
            'events' => $events,
            'categories' => $categories
        ]);
    }

    #[Route('/profil', name: 'app_profil_tournament')]
    public function eventAllByUser(EntityManagerInterface $entityManager)
    {
        $user = $this->getUser();
        $eventRepository = $entityManager->getRepository(Event::class);
        $eventUser = $eventRepository->findBy(['user' => $user]);

        return $this->render('profil/index.html.twig', [
            'eventUser' => $eventUser
        ]);
    }

    #[Route('/event/{id}/delete', name: 'app_event_delete', methods: ['POST'])]
    public function deleteEvent($id, EntityManagerInterface $entityManager): Response
    {
        $eventRepository = $entityManager->getRepository(Event::class);
        $event = $eventRepository->find($id);

        $entityManager->remove($event);
        $entityManager->flush();

        return $this->redirectToRoute('app_profil');
    }
}
